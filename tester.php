<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
body{
  font-family: 'Open Sans', sans-serif;
  font-size: 12px;
}
table{
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
}
td{
  border: 1px solid #cccccc;
  padding: 5px;
}
#wrapper{
  max-width: 1200px;
  margin: auto;
}
a{
  text-decoration: none;
  color: #000;
}
a:hover{
  text-decoration: underline;
}
</style>
</head>
<body>
  <div id="wrapper">
<?php
function Autoload($className){
    include_once('classes/'.$className . '.php');
}

spl_autoload_register('Autoload');

$tester = new Tester();

if(isset($_GET['make'])){
  switch ($_GET['make']){
    case 'add':
    $tester->addExamplesSms();
      break;
    case 'delete':
    $tester->delete();
      break;
    case 'status0':
    $tester->changeStatus0();
      break;
    case 'status1':
      $tester->changeStatus1();
      break;
    case 'status2':
      $tester->changeStatus2();
      break;
  }

  header('Location: tester.php');
  exit;
}







?>
<a href="tester.php?make=add">dodaj przykładowe smsy</a><br>
<a href="tester.php?make=delete">usuń wszystkie smsy</a><br>
<a href="tester.php?make=status0">zmień status wszystkich na "do wysłania, jeszcze nie przydzielone"</a><br>
<a href="tester.php?make=status1">zmień ststus wszystkich na "przydzielone"</a><br>
<a href="tester.php?make=status2">zmień ststus wszystkich na "wysłane"</a><br>

<h2>Lista urządzeń</h2>
<table>
  <tr><td>id</td> <td>token</td>  <td>device type</td> <td>interval time (s)</td> <td>last request</td></tr>
<?php
foreach($tester->showAllDevices() as $key=>$inside){
echo "<tr><td>".$inside[0]."</td>"."<td>".$inside[1]." (pass: Tajne".$inside[0]."#)</td>"."<td>".$inside[2]."</td>"."<td>".$inside[3]."</td>"."<td>".$inside[4]."</td></tr>";
}

?>
</table>


<h2>Lista wszystkich smsów</h2>
  <table>
    <tr><td>id</td> <td>phone number</td> <td>content</td> <td>date</td> <td>device id</td> <td>status</td></tr>
<?php
foreach($tester->showAllSms() as $key=>$inside){
  echo "<tr><td>".$inside[0]."</td>"."<td>".$inside[1]."</td>"."<td>".$inside[2]."</td>"."<td>".$inside[3]."</td>"."<td>".$inside[4]."</td>"."<td>".$inside[5]."</td></tr>";
}

?>
</table>
</div>
</body>
