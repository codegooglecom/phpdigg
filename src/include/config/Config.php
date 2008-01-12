<?php

class Config {
	public static $db_host 		= "localhost";
	public static $db_port		= 3306;
//	public static $db_name		= "PHPMONEY";
//	public static $db_user 		= "phpMoney";
	public static $db_name		= "digg";
	public static $db_user 		= "digg";
	public static $db_charset	= "utf-8";
	public static $db_password 	= "hello1234";
	
	public static $db_data_source_template 	= "mysql:dbname=%s;host=%s;port=%s;charset=%s";

	public static function getDateSourceName() {
		$dsn = sprintf(self::$db_data_source_template, self::$db_name, self::$db_host, self::$db_port, self::$db_charset);
		return $dsn;
	}
	
	public static $cookie_duration = 172800; #60*60*24*2
}


?>