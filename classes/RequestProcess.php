<?php
class RequestProcess extends ConnectionSettings{



  public function __construct(RequestCreator $creator, $requestRawData){
    //db connect
    $this->connect();

    //autoryzacja zapytania
    $this->creator = $creator;
    $this->response['return'] = ($this->creator->authorize($this->pdo, $requestRawData))?  1 : 0; //authorize() zwraca typ urządzenia 1,2.. lub 0

    //$this->response['debug_raw_data'] = $requestRawData;  //na potrzeby testów
  }


  public function doApiRequest(){
    if($this->response['return'] == 0) return $this->response;    //gdy autoryzacja się nie powiodła

    $this->request = $this->creator->createRequestObject();
    $this->request->updateLastRequest();

    if($this->request->getDeviceType() == 'app'){
        //send sms to db
        //$this->response['return'] =
         $this->request->sendSmsToDatabase();

    }elseif($this->request->getDeviceType() == 'transmitter'){
      //czy są jakieś "do wysłania"?
      if( sizeof($list = $this->request->getSmsToSend()) ){
        //wyślij komunikat zwrotny dla urządzenia z paczką sms
        $this->response['sms_list'] = $list;
      }else{
        //przypisz nową paczkę smsów dla danego urządzenia
        print_r($this->request->assignSmsToDevice());
        //wyślij komunikat zwrotny dla urządzenia z paczką sms
        $this->response['sms_list'] = $this->request->getSmsToSend();
      }
      //zmień status na wysłane
      $this->request->changeStatusSmsToSent();
    }

    return $this->response;
  }

}

?>
