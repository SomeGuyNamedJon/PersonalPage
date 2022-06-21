<?php
    function dbconnect($db){
        $user="webkit";
        $password="A4r5XPUST5wW";
        $hostname="localhost";
        return new mysqli($hostname, $user, $password, $db);
    }
?>