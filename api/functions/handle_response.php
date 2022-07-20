<?php
    function updateHeader($type, $code){
        header("Content-Type: $type");
        header("HTTP/1.1 $code");
    }

    function buildResponse($status, $msg, $data){
        $response = array(
            "Status" => $status,
            "Message" => $msg,
            "Data" => $data
        ); 
        return json_encode($response);
    }

    function respond($type, $code, $status, $msg, $data){
        updateHeader($type, $code);
        echo buildResponse($status, $msg, $data);
    }
?>