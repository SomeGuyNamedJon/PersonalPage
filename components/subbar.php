<?php
    $navContent = file_get_contents("../".$_POST['content']) or die("Nav bar file does not exist or not specified");
    $navContent = json_decode($navContent, true);
    $data = $navContent['data'];
    $default = $navContent['default'];

    if(isset($_POST['active']))
        $active = $_POST['active'];
    else
        $active = $default['page'];

    echo '<div class="row subBar">';

    foreach($data as $page => $entry){
        echo '<div class="col">
            <a id="'.$page.'" href="#" class="subButton '.(($page === $active) ? "active" : "").'" onclick="'.$entry['function'].';event.preventDefault()">
                <i class="'.$default['iconStyle'].' '.$entry['icon'].'"></i>
                '.$entry['name'].'
            </a>
        </div>';
    }

    echo '</div>'; 
?>