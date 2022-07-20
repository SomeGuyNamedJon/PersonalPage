<?php
    include("handle_response.php");

    function handleRoute($route){
        $route = strtolower($route);

        if(file_exists("routes/$route.php"))
            include("routes/$route.php");
        else{
            $type = 'application/json';
            $code = '404 Not Found';    
            $status = "Error";
            $msg = "Endpoint: $route Not Found";
            respond($type, $code, $status, $msg, null);
            die();
        }
    }
?>