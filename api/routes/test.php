<?php
    $type = 'application/json';
    $code = '200 OK';    
    $status = "OK";
    $msg = "This is a test endpoint";
    $data = array(
        "A" => "Apple",
        "B" => "Banana",
        "C" => "Carrot"
    );
    respond($type, $code, $status, $msg, $data);
    die();
?>