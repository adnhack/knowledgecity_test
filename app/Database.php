<?php

/*
* Class: Database
* Description: DB wrapper
* @author: Aaron Aceves
*/

class Database
{

  private $dbConnection = null;

  public function __construct()
  {

    //This is the right way to do it, but for simplicity add the details below
    $host = '127.0.0.1'; //getenv('DB_HOST');
    $port = 3306; //getenv('DB_PORT');
    $db   = 'testdb'; //getenv('DB_DATABASE');
    $user = 'root'; //getenv('DB_USERNAME');
    $pass = '12345678'; //getenv('DB_PASSWORD');

    try {
      $this->dbConnection = new \PDO("mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db", $user, $pass);
    } catch (\PDOException $e) {
      exit($e->getMessage());
    }

  }

  /*
  * Description: Return the DB conection
  * @visibility public
  * @param void
  * @return resource $db
  */
  public function getConnection()
  {
    return $this->dbConnection;
  }

}
