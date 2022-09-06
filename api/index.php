<?php
    include("../functions/database.php");
    include("functions/handle_route.php");
    
<<<<<<< HEAD
    $uri=parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    $uri=explode('&',$uri);
    $endpoint=$uri[0];
=======
    $uri=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri=str_replace('api/', '', $uri);
    $endpoint=$uri;
>>>>>>> eca8300 (Migration to InfinityFree)

    handleRoute($endpoint);

?>