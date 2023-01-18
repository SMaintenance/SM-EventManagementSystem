<?php

class DB {

    // private static $host = "localhost";
    // private static $database = "year2project";
    // private static $username = "root";
    // private static $password = "";

    public static function getConnection()
    {
        $config = require_once 'config.php';

        $host = $config['host'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];

        $dsn = 'mysql:host=' . $host . ';dbname=' . $database;

        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}
