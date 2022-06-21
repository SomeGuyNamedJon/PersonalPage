<?php

    include("database.php");
    $dblink = dbconnect("web_tech");

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $comment = $_POST['comment'];
    $err = "";

    $invalidRegex = "/^.*[%*:;$].*$/";
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

    if($comment == ""){
        $err .="CommentNull";
    }else{
        if(preg_match($invalidRegex, $comment))
            $err .= "CommentInvalid";
    }

    if($err != "")
        echo 'Error:'.$err;
    else{
        $fname = addslashes($fname);
        $lname = addslashes($lname);
        $comment = addslashes($comment);
        $phone = null;
        $method = 0;
        $email = "COMMENT_ONLY";
        $dob = $today;
        $sql = "insert into `contact_info` (`fname`,`lname`,`email`,`phone`,`dob`,`method`,`comment`) 
            values ('$fname', '$lname', '$email', '$phone', '$dob', $method, '$comment')";

        $dblink->query($sql) or die("Error: SQL Failed: $sql");

        echo "Success";
    }

?>
