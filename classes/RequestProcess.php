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
    try {
        $this->pdo = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME,self::DB_USERNAME,self::DB_PASSWORD);
    } catch (PDOException $e) {
        die($e->getMessage());
    }


    if(!isset($requestRawData['id']) OR !isset($requestRawData['token'])) {
      $requestRawData['id'] = '';
      $requestRawData['token'] = '';
    }

    $this->creator = $creator;
    $this->response['return'] = ($this->creator->authorize($this->pdo, $requestRawData['id'], $requestRawData['token']))?  1 : 0;
    $this->response['debug_raw_data'] = $requestRawData;
  }


  public function doApiRequest(){
    $this->request = $this->creator->createRequestObject();
    if( $this->request instanceof Request){
      if($this->request->getDeviceType() == 'app'){
          //send sms to db

      }elseif($this->request->getDeviceType() == 'transmitter'){
        //update interval time, assign sms to device, get sms to send, change status smsm to sended, send sms
        //dodaj liste otrzymanych sms do response
      }
  }


    return $this->response;
  }

}

?>
