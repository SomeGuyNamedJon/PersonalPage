<?php
    include('database.php');
    $dblink=dbconnect('web_tech');
    $sql = "select * from `work_entries`";
    $result = $dblink->query($sql) or die("Something went wrong with $sql");

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
            $logoSize = 70;
            $name = $entry['name'];
            $location = $entry['location'];
            $startDate = date("M Y", strtotime($entry['start_dt']));
            $endDate = date("M Y", strtotime($entry['end_dt']));
            $title = $entry['title'];
            $duties = $entry['duties'];

            echo "<br>
                <div class=\"row\">
                    <div class=\"col\" align=\"center\">
                        <img src=\"$logo\" alt=\"$name Logo\" height=\"$logoSize\" />
                        <h3>$name</h3>
                        <h4>$startDate - $endDate | $location</h4>
                    </div>
                    <div class=\"col\">
                        <dl>
                            <dt>Title:</dt>
                            <dd>$title</dd>
                            <dt>Duties:</dt>
                            <dd>$duties</dd>
                        </dl>
                    </div>
                </div>";

            if($key !== array_key_last($entries))
                echo "<hr>";
        }
    }
?>