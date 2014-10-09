<?php

	//Change these and save as config.php.
	
	//where files are stored
	define ('FILE_DIR','./files/');
	//characters to use in a random string
	//the matching directory facing the web
	define ('SERVER_DIR',$_SERVER['SERVER_NAME'].'/');

	define ('RAND_CHARS','ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
	//length of the random string
	define ('RAND_LEN',5);

	//the key/password to uload with
	define ('UP_KEY','helloServer');

	//database variables.
	define ('APP_DB_HOST','localhost');
	define ('APP_DB_USER','user');
	define ('APP_DB_PASSWORD','password');
	define ('APP_DB_DATABASE','database');