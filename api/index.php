<?php
    include("../functions/database.php");
    include("functions/handle_route.php");
    
    $uri=parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    $uri=explode('&',$uri);
    $endpoint=$uri[0];

    handleRoute($endpoint);

?>