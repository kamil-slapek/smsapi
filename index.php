<?php
function Autoload($className){
    include_once('classes/'.$className . '.php');
}

spl_autoload_register('Autoload');


//header('Content-Type: application/json');



$core = new RequestProcess($creator = new RequestCreator, $_GET);

echo json_encode($core->doApiRequest());






?>
