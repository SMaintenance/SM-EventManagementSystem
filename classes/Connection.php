<?php
class Connection {
    
    private static $connect = NULL;
    
    public static function getInstance() {
        if (Connection::$connect === NULL) {
            // connect to the database
            $host = "DB_HOST";
			$database = "DB_DATABASE";
			$username = "DB_USERNAME";
			$password = "DB_PASSWORD";

            $dsn = "mysql:host=" . $host . ";dbname=" . $database;

            $options = array(
                PDO::MYSQL_ATTR_SSL_CA => '/var/www/html/DigiCertGlobalRootCA.crt.pem'
            );
            Connection::$connect = new PDO($dsn, $username, $password, $options);
            if (!Connection::$connect) {
                die("Could not connect to database");
            }
        }
        
        return Connection::$connect;
    }
    
    public static function getMySQLDate($date) {
        $date_arr  = explode('-', $date);
        return $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
    }
}
