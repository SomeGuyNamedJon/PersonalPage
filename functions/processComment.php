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
        $phone = null;
        $method = 0;
        $email = "COMMENT_ONLY";
        $dob = $today;
        $sql = "insert into `contact_info` (`fname`,`lname`,`email`,`phone`,`dob`,`method`,`comment`) 
        	values (?, ?, ?, ?, ?, ?, ?)";
        
        # prepare and execute statement
        $stmt = $dblink->prepare($sql);
	$stmt->bind_param("sssssis", $fname, $lname, $email, $phone, $dob, $method, $comment);
	$stmt->execute() or die("Error: SQL Failed: $sql");
     
        echo "Success";
    }

?>
