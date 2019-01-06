<?php
$tablica = array(
    'id' => 4,
    'token' => '65E84BE33532FB784C48129675F9EFF3A682B27168C0EA744B2CF58EE02337C5',
    'sms_list' => array(
        0 => array('phone_number' => '987654321', 'content' => 'lorem ipsum'), 
        1 => array('phone_number' => '987654321', 'content' => 'lorem ipsum2'), 
        2 => array('phone_number' => '987654321', 'content' => 'lorem ipsum3'), 
        3 => array('phone_number' => '987654321', 'content' => 'lorem ipsum4'), 
        4 => array('phone_number' => '987654321', 'content' => 'lorem ipsum5') 
    )
);

header('Content-Type: application/json');
echo json_encode($tablica);
?>
