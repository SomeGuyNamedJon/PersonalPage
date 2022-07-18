<?php
    include('database.php');
    $dblink=dbconnect('web_tech');

    $sql = "select * from `home_img` order by `row`";
    $result = $dblink->query($sql) or die("Something went wrong with $sql");

    if($result->num_rows != 0){
        $i = 0;
        echo '<div class="row">';
        while($img = mysqli_fetch_assoc($result)){
            $title = $img['title'];
            $image = $img['image'];
            $height = $img['height'];
            $row = $img['row'];
            $imgId = strtolower(str_replace(' ', '', $title));

            if($row > $i){
                echo '</div><div class="row">';
                $i = $row;
            }

            echo '<div class="col">';
            echo "<h2>$title</h2>";
            echo '<div align="center"><img id="'.$imgId.'" src="'.$image.'" alt="'.$title.'" height="'.$height.'"></div></div>';
        }
        echo '</div>';
    }

    $sql = "select * from `home_about`";
    $result = $dblink->query($sql) or die("Something went wrong with $sql");

    if($result->num_rows == 0){
        echo '<div class=\"row justify-content-center\">
                <p class=\"help-block comment-help col-11\">Nothing to see here</p>
            </div>';
    }else{
        while($entry = mysqli_fetch_assoc($result)){
            $id = $entry['id'];
            $title = $entry['title'];
            $bulk = $entry['bulk'];
            $image = $entry['image'];
            $type = $entry['list_type'];
            $imgId = strtolower(str_replace(' ', '', $title));

            echo "<h2>$title</h2>";

            if($image)
                echo '<img id="'.$imgId.'" src="'.$image.'" alt="'.$title.'" height="100"></div>';

            if($type == null)
                echo "<ul><p>$bulk</b></ul>";
            else{

                echo "<$type>";
                
                if($bulk)
                    echo "<p>$bulk</p>";

                echo '<div class="row">';
                $sql = "select * from `about_bulletpoints` where `title_id`=$id";
                $subresult = $dblink->query($sql) or die("Something went wrong with $sql");
                while($bulletpoint = mysqli_fetch_assoc($subresult)){
                    $desc = $bulletpoint['description'];

                    if($type == 'dl'){
                        $term = $bulletpoint['term'];
                        echo "<dt>$term</dt>";
                        echo "<dd>$desc</dd>";
                    }else{
                        echo "<li>$desc</li>";
                    }
                }
                echo "</div></$type>";
            }
        }
    }
?>