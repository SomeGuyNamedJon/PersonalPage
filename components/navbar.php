<?php
    echo '<div class="container">
        <div class="row navBar">
                <div class="col">
                    <a id="home" href="#" class="navButton" onclick="updateContent(\'home\');event.preventDefault()">Home</a>
                </div>
                <div class="col">
                    <a id="school" href="#" class="navButton" onclick="updateContent(\'school\');event.preventDefault()">School</a>
                </div>
                <div class="col">
                    <a id="work" href="#" class="navButton" onclick="updateContent(\'work\');event.preventDefault()">Work</a>
                </div>
                <div class="col">
                    <a id="contact" href="#" class="navButton" onclick="updateContent(\'contact\');event.preventDefault()">Contact</a>
                </div>
                <div class="col">
                    <a id="comments" href="#" class="navButton" onclick="updateContent(\'comments\');event.preventDefault()">Comments</a>
                </div>
            </div>
    </div>';
?>