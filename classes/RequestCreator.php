<?php
class RequestCreator{
  private $requestType;

  public function authorize($pdo, $id, $token){
    $this->pdo = $pdo;
    $sth = $this->pdo->prepare("SELECT device_type FROM devices WHERE id = :id AND token = :token ");
    $sth->execute(array(":id"=>$id, ":token" => $token));

    if($sth->rowCount()){
      $r=$sth->fetch();
      $this->requestType = $r[0];
      return 1;
    }else{
      $this->requestType = 0;
      return 0;
    }

  }


  public function createRequestObject(){

    $request = NULL;
    if($this->requestType == 1){
      $request = new RequestApplication;
    }if($this->requestType == 2){
      $request = new RequestTransmitter;
    }

    return $request;
  }

}

?>
