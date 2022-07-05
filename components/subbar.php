<?php
    switch($_POST['active']){
        case 'Comment':
            $comment='active';
            break;
        case 'Info':
            $info='active';
            break;
    }

    echo '<div class="row subBar">
                <div class="col">
                    <a id="CommentForm" href="#" class="subButton '.$comment.'" onclick="updateSubContent(\'Comment\');event.preventDefault()">Submit Comment</a>
                </div>
                <div class="col">
                    <a id="InfoForm" href="#" class="subButton '.$info.'" onclick="updateSubContent(\'Info\');event.preventDefault()">Submit Contact Info</a>
                </div>
            </div>';
?>