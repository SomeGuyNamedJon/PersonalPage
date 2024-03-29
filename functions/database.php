<?php

    //get credentials from file
    $keyfile = file_get_contents("../../secrets/personalpage.json");
    $credentials = json_decode($keyfile, true);

    function dbconnect($db){
        global $credentials;

        $user     = $credentials["user"];
        $password = $credentials["password"];
        $hostname = $credentials["hostname"];

        return new mysqli($hostname, $user, $password, $db);
    }
?>