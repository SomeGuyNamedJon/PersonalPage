<?php
    $type = 'application/json';
    $code = '200 OK';    
    $status = "OK";
    $msg = "This is a test endpoint for arguments";
    $data = $_REQUEST;
    respond($type, $code, $status, $msg, $data);
    die();
?>