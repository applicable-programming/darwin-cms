<?php

final class DatabaseConnection {
    
    private static $instance = null;
    private static $connection;
    
    public static function getInstance() {
        if (is_null(self::$instance)){
            self::$instance = new DatabaseConnection();
        }
        
        return self::$instance;
    }
    
    private function __construct() {}
    
    private function __clone() {}
    
    private function __wakeup() {}
    
    
    public static function connect($host, $dbName, $user, $password){
        self::$connection = new PDO("mysql:dbname=$dbName;host=$host", $user, $password);
    }
    
    public static function getConnection() {
        return self::$connection;
    }
    

}