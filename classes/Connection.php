<?php
class Connection
{
    private static $connect = null;
    
    public static function getInstance()
    {
        if (Connection::$connect === null) {
            // connect to the database
            // $host = "localhost";
		    // $database = "year2project";
		    // $username = "root";
		    // $password = "";
            $host = "localhost";
			$database = "id20148164_urban_event";
			$username = "id20148164_urbanevent";
			$password = "S!hqGQf+2=ut)etm";

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
