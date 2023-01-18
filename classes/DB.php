<?php

class DB {

    // private static $host = "localhost";
    // private static $database = "year2project";
    // private static $username = "root";
    // private static $password = "";
    private static $host = "localhost";
    private static $database = "id20148164_urban_event";
    private static $username = "id20148164_urbanevent";
    private static $password = "S!hqGQf+2=ut)etm";

    public static function getConnection()
    {
        $dsn = 'mysql:host=' . DB::$host . ';dbname=' . DB::$database;

        $connection = new PDO($dsn, DB::$username, DB::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}
