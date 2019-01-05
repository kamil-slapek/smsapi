<?php
class RequestTransmitter extends DevicesRequest implements Request{


  public function getDeviceType(){
    return "transmitter";
  }

  public function getSmsToSend(){
    $sth = $this->pdo->prepare("SELECT phone_number, content FROM sms WHERE device_id=:device_id AND status=1");
    $sth->execute(array(":device_id" => $this->deviceData['id']));
    return $sth->fetchAll();
  }

  public function assignSmsToDevice(){

    $limit=floor(60/$this->deviceData['interval_time']);

    $sth = $this->pdo->prepare("UPDATE sms SET status=1, device_id=:id WHERE device_id=0 AND status=0 ORDER BY id LIMIT ".$limit);
    $sth->execute(array(":id" => $this->deviceData['id'] ));

  }

  public function changeStatusSmsToSent(){
    $sth = $this->pdo->prepare("UPDATE sms SET status=2 WHERE device_id=:id AND status=1");
    $sth->execute(array(":id" => $this->deviceData['id'] ));
  }
}

?>
