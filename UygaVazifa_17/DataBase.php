<?php

class DataBase{

    protected static $localhost = "localhost";
    protected static $database = "oopda";
    protected static $username = "root";
    protected static $password = "root";
    protected static $connection;
    
    public static function connect(){
        return self::$connection = new PDO("mysql:host=" . self::$localhost . ";dbname=" . self::$database, self::$username, self::$password);
    }
}

?>