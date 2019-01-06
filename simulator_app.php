<form action="simulator_app.php" method="GET">
 Id:<br>
 <input type="text" name="id" value="4"><br>
 Token:<br>
 <input type="text" name="token" value="65E84BE33532FB784C48129675F9EFF3A682B27168C0EA744B2CF58EE02337C5"><br>
 Numbers:<br>
 <textarea name="numbers">123</textarea><br>
  Message:<br>
<textarea name="message">qwerty</textarea><br>
 <input type="submit" value="Submit">
</form>
<?php
if( isset($_GET['id']) ){
  if(($_GET['id'] != NULL) && ($_GET['token'] != NULL) && ($_GET['numbers'] != NULL) && ($_GET['message'] != NULL) ){
    $data['id'] = $_GET['id'];
    $data['token'] = $_GET['token'];

    $number_list = explode("\n", $_GET['numbers']);
    foreach($number_list as $key=>$a){
      $data['sms_list'][$key]['phone_number'] = $number_list[$key];
      $data['sms_list'][$key]['content'] = $_GET['content'];
    }


    $jsonurl = "http://localhost/smsapi/index.php?".http_build_query($data, '', '&');
    $json = file_get_contents($jsonurl);
    $response = json_decode($json, true);
    if($response['return'] == 1){
      echo 'Poprawnie dodano smsy do wysłania.'."<br><br>";
    }else{
      echo 'błąd!'."<br><br>";
    }
    echo "url: $jsonurl <br><br>";
    echo "response: $json <br><br>";
  }else{
    echo 'niekompletne dane';
  }
}

?>
