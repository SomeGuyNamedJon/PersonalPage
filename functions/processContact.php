<?php

    include("database.php");
    $dblink = dbconnect("web_tech");

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $comment = $_POST['comment'];
    $err = "";

    $invalidRegex = "/^.*[%*:;$].*$/";
    $emailRegex = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
    //$phoneRegex = "/^\d\d\d-\d\d\d-\d\d\d\d$/";
    $phoneRegex = "/^(\+1)?(-|\.)?(\([0-9]{3}\)|[0-9]{3})(-|\.)?[0-9]{3}(-|\.)?[0-9]{4}$/";
    $today = date("Y-m-d");

    if($fname == "")
        $err .= "FnameNull";
    else {
        if(preg_match($invalidRegex, $fname))
            $err .= "FnameInvalid";
    }

    if($lname == "")
        $err .= "LnameNull";
    else {
        if(preg_match($invalidRegex, $lname))
            $err .= "LnameInvalid";
    }

    if($email == "")
        $err .= "EmailNull";
    else { 
        if(!preg_match($emailRegex, $email))
            $err .= "EmailInvalid";
    }
    
    if($phone == "")
        $err .= "PhoneNull";
    else { 
        if(!preg_match($phoneRegex, $phone))
            $err .= "PhoneInvalid";
    }

    if($dob == "")
        $err .= "DateNull";
    else {
        if($dob > $today)
            $err .= "DateInvalid";
    }

    if($contact == "")
        $err .= "ContactNull";
    
    if(preg_match($invalidRegex, $comment))
        $err .= "CommentInvalid";

    if($err != "")
        echo 'Error:'.$err;
    else{
        $fname = addslashes($fname);
        $lname = addslashes($lname);
        $comment = addslashes($comment);
        $phone = preg_replace('[\D]', '', $phone);
        $method = ($contact == "Email") ? 1 : 0;
        $sql = "insert into `contact_info` (`fname`,`lname`,`email`,`phone`,`dob`,`method`,`comment`) 
            values ('$fname', '$lname', '$email', '$phone', '$dob', $method, '$comment')";

        $dblink->query($sql) or die("Error: SQL Failed: $sql");

        echo "Success";
    }

?>
