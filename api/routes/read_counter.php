<?php
    $counterFile = "../assets/json/counter.json";
    $countData = file_get_contents($counterFile);
    $countData = json_decode($countData, true);

    $type = 'application/json';
    $code = '200 OK';    
    $status = "OK";
    $msg = "Counter Log";
    
    respond($type, $code, $status, $msg, $countData);
    die();
?>