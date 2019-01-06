<?php
$tablica = array(
    'id' => 2,
    'token' => '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918',
    'interval_time' => 15,
);

header('Content-Type: application/json');
echo json_encode($tablica);
?>
