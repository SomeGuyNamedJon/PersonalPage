<?php
    switch($_POST['active']){
        case 'school':
            $school='active';
            break;
        case 'work':
            $work='active';
            break;
        case 'contact':
            $contact='active';
            break;
        case 'comments':
            $comments='active';
            break;
        default:
            $home='active';
    }

    echo '<div class="container">
        <div class="row navBar">
                <div class="col">
                    <a id="home" href="#" class="navButton '.$home.'" onclick="updateContent(\'home\');event.preventDefault()">Home</a>
                </div>
                <div class="col">
                    <a id="school" href="#" class="navButton '.$school.'" onclick="updateContent(\'school\');event.preventDefault()">School</a>
                </div>
                <div class="col">
                    <a id="work" href="#" class="navButton '.$work.'" onclick="updateContent(\'work\');event.preventDefault()">Work</a>
                </div>
                <div class="col">
                    <a id="contact" href="#" class="navButton '.$contact.'" onclick="updateContent(\'contact\');event.preventDefault()">Contact</a>
                </div>
                <div class="col">
                    <a id="comments" href="#" class="navButton '.$comments.'" onclick="updateContent(\'comments\');event.preventDefault()">Comments</a>
                </div>
            </div>
    </div>';
?>