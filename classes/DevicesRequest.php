<?php
class DevicesRequest implements Request{
  protected $deviceData;
  protected $requestData;
  protected $pdo;

  public function __construct($pdo, $deviceData, $requestData){
    $this->pdo = $pdo;
    $this->deviceData = $deviceData;
    $this->requestData = $requestData;
  }

  public function updateLastRequest(){
    $sth = $this->pdo->prepare("UPDATE devices SET last_request=now() WHERE id=:id");
    $sth->execute(array(":id"=>$this->deviceData['id']));
  }

  public function getDeviceType(){
    return "unsigned";
  }

}

?>
