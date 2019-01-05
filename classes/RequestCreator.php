<?php
class RequestCreator{
  private $requestType;
  private $deviceData;
  private $requestData;
  private $pdo;

  public function authorize($pdo, $requestRawData){

    if(isset($requestRawData['id']) AND isset($requestRawData['token'])) {
      $this->pdo = $pdo;
      $sth = $this->pdo->prepare("SELECT * FROM devices WHERE id = :id AND token = :token ");
      $sth->execute(array(":id"=>$requestRawData['id'], ":token" => $requestRawData['token']));

      if($sth->rowCount()){
        $r=$sth->fetch();
        $this->requestType = $r['device_type'];
        $this->deviceData = $r;
        $this->requestData = $requestRawData;
        return 1;
      }
    }

      $this->requestType = 0;
      $this->requestData = NULL;
      $this->deviceData = NULL;
      return 0;
  }


  public function createRequestObject(){

    $request = NULL;
    if($this->requestType == 1){
      $request = new RequestTransmitter($this->pdo, $this->deviceData, $this->requestData);
    }if($this->requestType == 2){
      $request = new RequestApplication($this->pdo, $this->deviceData, $this->requestData);
    }

    return $request;
  }

}

?>
