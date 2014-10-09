<?php
Class Database {

	//the database will live in here.
	private static $db;

	/**
	* Open new local database connection
	*
	* @return mysqli
	*/
	public static function get() {

		//has the datbase been kicked in yet?
		if (!is_a(self::$db, "mysqli")) {
			//no, so kick it in!
			self::$db = new mysqli(
				APP_DB_HOST,
				APP_DB_USER,
				APP_DB_PASSWORD,
				APP_DB_DATABASE
			);
			//check our connection was successful, or die if it wasnt

			if (self::$db->connect_error) {
				die('<h1>Database Error! (' . self::$db->connect_errno . ') </h1>');
			}			
		}

		//by the time we get here we have a database object ready to go, return it for use.
		return self::$db;
	}
}
?>