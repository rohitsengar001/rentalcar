<?php

namespace api\common;
use mysqli;


interface connect_interface{
    
    public static function connect();
}

class DbConnection implements connect_interface
{
    private $server;
    private $username;
    private $password;
    private $database;
    private static $conn;
    private static $class_instance;

    function __construct($server, $username, $password, $database)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    // @return: connection object of database 
    //Singleton desining pattern is applied
    public static function connect()
    {
        //get DbConnection object 
        $instance = self::getInstance();
        //get $conn object
        $conn = $instance->initConnection();
        if($conn->connect_error){
            echo "Database Connection Error";
        }
        return $conn;
    }


    //@return $
    private static function getInstance()
    {
        if (self::$class_instance == null) {
            self::$class_instance = new DbConnection('localhost', 'root', '', 'rental');
        }
        return self::$class_instance;
    }

    private function initConnection()
    {
        // singleton instance of Database Connection
            if (self::$class_instance != null) {
                self::$conn = new mysqli(
                    self::$class_instance->server,
                    self::$class_instance->username,
                    self::$class_instance->password,
                    self::$class_instance->database,
                );
            }
        
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
        return self::$conn;
    }
}
