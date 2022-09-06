<?php

    //get credentials from file
<<<<<<< HEAD
    $keyfile = file_get_contents("/etc/credentials/personalpage.json");
=======
    $keyfile = file_get_contents("../../secrets/personalpage.json");
>>>>>>> eca8300 (Migration to InfinityFree)
    $credentials = json_decode($keyfile, true);

    function dbconnect($db){
        global $credentials;

        $user     = $credentials["user"];
        $password = $credentials["password"];
        $hostname = $credentials["hostname"];

        return new mysqli($hostname, $user, $password, $db);
    }
?>