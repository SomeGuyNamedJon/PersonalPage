<?php
    include('database.php');
<<<<<<< HEAD
    $dblink=dbconnect('web_tech');
=======
    $dblink=dbconnect('epiz_32266982_personal_page');
>>>>>>> eca8300 (Migration to InfinityFree)
    $sql = "select * from `contact_info` where `comment` is not null order by `auto_id` desc";
    $result = $dblink->query($sql) or die("Something went wrong with $sql");

    echo '<br>';
    if($result->num_rows == 0){
        echo '<div class="row justify-content-center">
                <p class="help-block comment-help col-11">Nothing to see here</p>
            </div>';
    }else{
        while($entry = mysqli_fetch_assoc($result)){
            $fname = $entry['fname'];
            $lname = $entry['lname'];
            $comment = $entry['comment'];

            if($comment != ''){
                echo '<div class="comment row justify-content-center">';
                echo '<div class="col-11">';    
                echo '<p>'.$comment.'</p>';
                echo '</div>';
                echo '</div>';

                if($fname != null)
                    echo '<p class="comment label">- '.$fname.' '.$lname[0].'.</p>';
                else
                    echo '<p class="comment label">- Anonymous</p>';
            }
        }
    }
?>