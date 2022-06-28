<?php
    include('database.php');
    $dblink=dbconnect('web_tech');
    $sql = "select * from `school_entries`";
    $result = $dblink->query($sql) or die("Something went wrong with $sql");

    echo '<br>';
    if($result->num_rows == 0){
        echo '<div class=\"row justify-content-center\">
                <p class=\"help-block comment-help col-11\">Nothing to see here</p>
            </div>';
    }else{
        while($entry = mysqli_fetch_assoc($result)){
            $entries[] = $entry;
        }

        foreach($entries as $key => $entry){
            $id = $entry['id'];
            $logo = $entry['logo'];
            $name = $entry['name'];
            $state = $entry['state'];
            $gradDate = date("M Y", strtotime($entry['graduated']));
            $degree = $entry['degree'];
            $gpa = $entry['gpa'];
            $other = $entry['other'];

            echo "<div class=\"row\">
            <div class=\"col\" align=\"center\">
                <br>
                <img src=\"$logo\" alt=\"$name Logo\" height=\"60\">
                <h3>$name, $state</h3>
                <h3>Graduated $gradDate</h3>
                <h4>$degree</h4>";
                if($gpa != null)
                    echo "<h4>$gpa GPA</h4>";
                if($other != null)
                    echo "<h4>$other</h4>";    
            echo "</div>";

            echo "<div class=\"col\">";
            $sql = "select * from `school_bulletpoints` where `school_id`=$id";
            $subresult = $dblink->query($sql) or die("Something went wrong with $sql");
            while($bulletpoint = mysqli_fetch_assoc($subresult)){
                $name = $bulletpoint['name'];
                $desc = $bulletpoint['description'];

                echo "<dl>
                        <dt>$name</dt>
                        <dd>$desc</dd>
                    </dl>";
            }
            echo "</div></div>";

            if($key !== array_key_last($entries))
                echo "<hr>";
        }
    }
?>