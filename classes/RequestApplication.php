<?php
class RequestApplication extends DevicesRequest implements Request{

  public function getDeviceType(){
    return "app";
  }
}

?>
