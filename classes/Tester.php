<?php

class Tester{

  const DB_HOST = 'localhost';
  const DB_NAME = 'ktrl_1';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';

  private $creator;
  private $request;
  private $pdo;
  private $response;

  public function __construct(){
    try {
        $this->pdo = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME,self::DB_USERNAME,self::DB_PASSWORD);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

  }

  public function addSmsToDb($phone_number='', $content='', $device_id=NULL, $status=0, $date = NULL){
    if($date == NULL) $date = date("Y-m-d H:i:s");
    $sth = $this->pdo->prepare("INSERT INTO sms (phone_number, content, date, device_id, status) VALUES(:phone_number, :content, :date, :device_id, :status)");
    $sth->execute(array(":phone_number"=>$phone_number, ":content"=>$content, ":date"=>$date, ":device_id"=>$device_id, ":status" => $status));
  }

  public function addExamplesSms(){
    $examples = array(
    array("987654321","Lorem ipsum dolor sit amet, consectetur adipiscing elit.",0,0, NULL),
    array("987654321","A long time ago in a galaxy far, far away… ",0,0, NULL),
    array("987654321","The Force will be with you. Always.",0,0, NULL),
    array("987654321","Do. Or do not. There is no try.",0,0, NULL),
    array("987654321","No. I am your father.",0,0, NULL),
    array("987654321","Co to jest? Dlaczego ta świnia ma kły?",0,0, NULL),
    array("987654321","Ups… Przepraszam, szefie, wymsknęło mi się…",0,0, NULL),
    array("987654321","Ale pan Krzysztof Jarzyna ze Szczecina jest szefem wszystkich szefów. Co z?ego, to nie my.",0,0, NULL),
    array("987654321","Nie twoja sprawa… Bambo.",0,0, NULL),
    array("987654321","Słuchawkę, no tak, że niby mam kontakt z bazą.",0,0, NULL),
    array("987654321","Pracowałem w rozlewni jogurtów, jak mnie wywalili, to powiedzieli, żebym sobie je zabrał.",0,0, NULL),
    array("987654321","Gardło pana boli szefie?",0,0, NULL)
  );

    foreach($examples as $key=>$inside){
      $this->addSmsToDb($inside[0], $inside[1], $inside[2], $inside[3], $inside[4]);
    }
  }

  public function showAllSms(){
    $sth = $this->pdo->prepare("SELECT * FROM sms WHERE 1");
    $sth->execute();
    return $sth->fetchAll();
  }

  public function showAllDevices(){
    $sth = $this->pdo->prepare("SELECT * FROM devices WHERE 1");
    $sth->execute();
    return $sth->fetchAll();
  }

  public function delete(){
    $sth = $this->pdo->prepare("DELETE FROM sms WHERE 1");
    $sth->execute();
  }
  public function changeStatus0(){
    $sth = $this->pdo->prepare("UPDATE sms SET status=0 WHERE 1=1");
    $sth->execute();
  }
  public function changeStatus1(){
    $sth = $this->pdo->prepare("UPDATE sms SET status=1 WHERE 1=1");
    $sth->execute();
  }
  public function changeStatus2(){
    $sth = $this->pdo->prepare("UPDATE sms SET status=2 WHERE 1=1");
    $sth->execute();
  }
}


?>
