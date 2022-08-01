<?php

namespace api\common;

use Exception;
use mysqli;

class test
{
    private $server;
    private $user;
    private$password;
    private $dbname;

  function __construct(){
      $this->server="localhost";
      $this->user="root";
      $this->password="";
      $this->dbname="rentalcar";
  }
  function connect(){
      $conn=new mysqli($this->server,$this->user,$this->password,$this->dbname);
      if($conn->connect_error)
          echo "Error while connecting databasae";
      return $conn->query("SELECT * FROM `auth_table`");
  }

}
$obj=new test();
try {
    $data=$obj->connect();
    if($data->num_rows>0){
        $rec=$data->fetch_array();
        echo $rec[0]."\n".$rec[1];
    }
}catch (Exception $e){
    echo "Error while connecting";
}
