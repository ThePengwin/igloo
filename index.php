<?php

require 'vendor/autoload.php';
require 'lib/Database.php';

if (!file_exists('config.php')) die ('Not configured');

require 'config.php';

$app = new \Slim\Slim();

$app->get('/(:file)', function ($file=null) use ($app) {
	
	if (empty($file)) $app->notFound();
	if (!file_exists(FILE_DIR.$file)) $app->notFound();

	$db = Database::get();
	
	$get_file_sql = $db->prepare('SELECT `id`,`mime`,`uploaded`,`filename` FROM files WHERE id=?');
	$get_file_sql->bind_param('s',$file);
	$get_file_sql->execute();
	$get_file_sql->bind_result($id, $mime, $uploaded, $filename);

	if (!$get_file_sql->fetch()) $app->notFound();
	
	header('Content-Type: '.$mime);
	header('Content-Length: ' . filesize(FILE_DIR.$file));
	header('Content-Disposition: filename="'.$filename.'"');
	readfile(FILE_DIR.$file);
	exit;
});

$app->post('/up', function () use ($app) {
	
	if ($app->request->post('k') != UP_KEY) $app->halt(403,'None shall pass');

	if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK ) $app->halt(400,'Bad input Bro');	

	do {
		$file = '';
		for ($i=0;$i<RAND_LEN;$i++) {
			$file .= substr(RAND_CHARS,rand(0,strlen(RAND_CHARS)),1);
		}
		$not_unique_filename = file_exists(FILE_DIR.$file);

	} while ($not_unique_filename); 

	if (move_uploaded_file($_FILES['file']['tmp_name'],FILE_DIR.$file)) {

		$db = Database::get();

		$new_file_sql = $db->prepare('INSERT INTO `files` (`id`,`mime`,`uploaded`,`filename`) VALUES (?,?,?,?)');
		$new_file_sql->bind_param('ssss',$file,$_FILES['file']['type'],time(),$_FILES['file']['name']);

		if (!$new_file_sql->execute()) $app->halt(500,'I Have failed you');

		$app->halt(200,$app->request->getScheme().'://'.SERVER_DIR.$file);

	} else {
		
		$app->halt(500,'I Have failed you');
	
	}
	

});

$app->run();
