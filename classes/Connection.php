<?php


class Connection
{
    private static $connect = null;
    
    public static function getInstance()
    {
        $config = require_once 'config.php';

        if (Connection::$connect === null) {
            
            // connect to the database
            $host = $config['host'];
			$database = $config['database'];
			$username = $config['username'];
			$password = $config['password'];

            $dsn = "mysql:host=" . $host . ";dbname=" . $database;

            Connection::$connect = new PDO($dsn, $username, $password);
            if (!Connection::$connect) {
                die("Could not connect to database");
            }
        }
        
        return Connection::$connect;
    }
    
    public static function getMySQLDate($date)
    {
        $date_arr  = explode('-', $date);
        return $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
    }
}
