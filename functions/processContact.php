<?php

    include("database.php");
    $dblink = dbconnect("epiz_32266982_personal_page");

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
    
    if($comment == "")
        $comment = null;
    else{
        if(preg_match($invalidRegex, $comment))
            $err .= "CommentInvalid";
    }

    if($err != "")
        echo 'Error:'.$err;
    else{
        $phone = preg_replace('[\D]', '', $phone);
        $sql = "insert into `contact_info` (`fname`,`lname`,`email`,`phone`,`dob`,`method`,`comment`) 
            values (?, ?, ?, ?, ?, ?, ?)";

        # prepare and execute statement
        $stmt = $dblink->prepare($sql);
        $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $dob, $contact, $comment);
	    $stmt->execute() or die("Error: SQL Failed: $sql");
	   
        echo "Success";
    }

?>
