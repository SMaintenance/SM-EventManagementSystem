<?php
class DB {

    private static $host = "DB_HOST";
    private static $database = "DB_DATABASE";
    private static $username = "DB_USERNAME";
    private static $password = "DB_PASSWORD";
    
    public static function getConnection() {
        $dsn = 'mysql:host=' . DB::$host . ';dbname=' . DB::$database;

        $connection = new PDO($dsn, DB::$username, DB::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}