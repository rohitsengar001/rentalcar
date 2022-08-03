<?php
namespace rentalcar\api\common;
use mysqli;

interface connect_interface
{
    /**
     * @return mysqli $conn =>Mysqli object
     * 😍
     */
    public static function connect(): mysqli;
}

class DbConnection implements connect_interface
{
    private static $conn;
    private static $class_instance;
    private $server;
    private $username;
    private $password;
    private $database;

    function __construct($server, $username, $password, $database)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    // @return: connection object of database 
    //Singleton designing pattern is applied
    public static function connect(): mysqli
    {
        //get DbConnection object 
        $instance = self::getInstance();
        //get $conn object
        $conn = $instance->initConnection();
        if ($conn->connect_error) {
            echo "Database Connection Error";
        }
        return $conn;
    }


    /**
     * @return Object  $class_instance
     *🍝:return the object of DbConnection
     */
    private static function getInstance()
    {
        if (self::$class_instance == null) {
            self::$class_instance = new DbConnection(
                'localhost',
                'root'
                , ''
                , 'rentalcar'
            );
        }
        return self::$class_instance;
    }

    private function initConnection(): mysqli
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
        return self::$conn;
    }
}


