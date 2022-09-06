<?php
    include("../functions/database.php");
    include("functions/handle_route.php");
    
    $uri=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri=str_replace('api/', '', $uri);
    $endpoint=$uri;

    handleRoute($endpoint);

?>