<?php
class RequestProcess {


  const DB_HOST = 'localhost';
  const DB_NAME = 'ktrl_1';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';

  private $creator;
  private $request;
  private $pdo;
  private $response;

  public function __construct(RequestCreator $creator, $requestRawData){
    //db connect
    try {
        $this->pdo = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME,self::DB_USERNAME,self::DB_PASSWORD);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    //autoryzacja zapytania
    $this->creator = $creator;
    $this->response['return'] = ($this->creator->authorize($this->pdo, $requestRawData))?  1 : 0; //authorize() zwraca typ urządzenia 1,2.. lub 0

    $this->response['debug_raw_data'] = $requestRawData;  //na potrzeby testów
  }


  public function doApiRequest(){
    if($this->response['return'] == 0) return $this->response;    //gdy autoryzacja się nie powiodła

    $this->request = $this->creator->createRequestObject();
    $this->request->updateLastRequest();

    if($this->request->getDeviceType() == 'app'){
        //send sms to db

    }elseif($this->request->getDeviceType() == 'transmitter'){
      //update interval time, assign sms to device, get sms to send, change status smsm to sended, send sms
      //dodaj liste otrzymanych sms do response

      //czy są jakieś "do wysłania"?
      if(){
        //wyślij komunikat zwrotny dla urządzenia z paczką sms
      }else{
        //przypisz nową paczkę smsów dla danego urządzenia
        //wyślij komunikat zwrotny dla urządzenia z paczką sms
        //zmień status na wysłane


      }
    }


    return $this->response;
  }

}

?>
