<?php
class ConnectionSettings {
  const DB_HOST = 'localhost';
  const DB_NAME = 'ktrl_1';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';

  protected $pdo;

  protected function connect(){
    try {
      $this->pdo = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME,self::DB_USERNAME,self::DB_PASSWORD);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }


}

?>
