<?php
class RequestApplication extends DevicesRequest implements Request{

  public function getDeviceType(){
    return "app";
  }

  public function sendSmsToDatabase(){
    print_r($this->requestData['sms_list']);
    foreach($this->requestData['sms_list'] as $arr){
    //  print_r($arr);
      $this->addSmsToDb($arr['phone_number'], $arr['content'], 0, 0);
    }
  }

  private function addSmsToDb($phone_number='', $content='', $device_id=NULL, $status=0, $date = NULL){
    if($date == NULL) $date = date("Y-m-d H:i:s");
    $sth = $this->pdo->prepare("INSERT INTO sms (phone_number, content, date, device_id, status) VALUES(:phone_number, :content, :date, :device_id, :status)");
    $sth->execute(array(":phone_number"=>$phone_number, ":content"=>$content, ":date"=>$date, ":device_id"=>$device_id, ":status" => $status));
  }

}

?>
