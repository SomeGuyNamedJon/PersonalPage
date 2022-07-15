<?php
    echo '<br>';

    echo '<div class="row">
            <p id="successBox"></p>
        </div>';

    echo '<div class="form">';

        echo '<div id="fnameBox">
                <label>First Name</label>
                <input class="form-input" type="text" id="fname" name="fname">
                <p class="help-block" id="fnameHelp"></p>
            </div>';

        echo '<div id="lnameBox">
                <label>Last Name</label>
                <input class="form-input" type="text" id="lname" name="lname">
                <p class="help-block" id="lnameHelp"></p>
            </div>';

        echo '<div id="anonBox">
                <label>Anonymous?</label>
                <div class="row">
                    <div class="col"> 
                        <label for="anon">    
                        <input class="form-check" type="checkbox" id="anonStatus" name="anonStatus">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M284.9 320l-60.9-.0002c-88.36 0-160 71.63-160 159.1C63.1 497.7 78.33 512 95.1 512l448-.0039c.0137 0-.0137 0 0 0l-14.13-.0013L284.9 320zM630.8 469.1l-249.5-195.5c48.74-22.1 82.65-72.1 82.65-129.6c0-79.53-64.47-143.1-143.1-143.1c-69.64 0-127.3 49.57-140.6 115.3L38.81 5.109C34.41 1.672 29.19 0 24.03 0C16.91 0 9.845 3.156 5.127 9.187c-8.187 10.44-6.375 25.53 4.062 33.7L601.2 506.9c10.5 8.203 25.56 6.328 33.69-4.078C643.1 492.4 641.2 477.3 630.8 469.1z"/></svg>
                        </label>
                    </div>
                </div>
            </div><br>';

        echo '<div id="commentBox">
                <label>Comment</label>
                <textarea class="form-input" id="comment" name="comment" rows="10"></textarea>
                <p class="help-block" id="commentHelp"></p>
            </div>';
        
        echo '<button class="btn" id="submitBtn">
            <i class="fa-solid fa-circle-check"></i>    
            Submit
        </button>';
        echo '<div class="ans-box" id="values"></div>';

    echo '</div>'; 
?>

<script>
$('#anonStatus').on('click', function() {
    try{
        var anonState = document.querySelector('input[name="anonStatus"]:checked').value;
    }catch(err){
        var anonState = null;
    }
    var fnameInput = document.getElementById("fname");
    var lnameInput = document.getElementById("lname");

    if(anonState){
        fnameInput.disabled = true;
        lnameInput.disabled = true;
    }else{
        fnameInput.disabled = false;
        lnameInput.disabled = false;
    }
});

$('#submitBtn').on('click',function(){
    try{
        var anonymous = document.querySelector('input[name="anonStatus"]:checked').value;
    }catch(err){
        var anonymous = null;
    }
    var dataArr = {
        'fname' : document.getElementById('fname').value,
        'lname' : document.getElementById('lname').value,
        'comment' : document.getElementById('comment').value,
        'anonymous' : anonymous
    }
    $.ajax({
        type:'post',
        url:'../functions/processComment.php',
        data: dataArr,
        success:function(data){
            //Help and form boxes
            var successBox = document.getElementById("successBox");
            var fnameBox = document.getElementById("fnameBox");
            var fnameHelp = document.getElementById("fnameHelp");
            var lnameBox = document.getElementById("lnameBox");
            var lnameHelp = document.getElementById("lnameHelp");
            var commentBox = document.getElementById("commentBox");
            var commentHelp = document.getElementById("commentHelp");
            fnameBox.classList.remove("form-err");
            lnameBox.classList.remove("form-err");
            commentBox.classList.remove("form-err");
            successBox.classList.remove("success-box");

            fnameHelp.innerHTML = "";
            lnameHelp.innerHTML = "";
            commentHelp.innerHTML = "";
            successBox.innerHTML = "";

            if(data.includes("Error")){
                if(data.includes("SQL")){
                    alert(data);
                }

                if(data.includes("FnameNull")){
                    fnameBox.classList.add("form-err");
                    fnameHelp.innerHTML = "First Name must not be blank";
                }else if(data.includes("FnameInvalid")){
                    fnameBox.classList.add("form-err");
                    fnameHelp.innerHTML = "First Name contains invalid character(s) % * : ; $";
                }

                if(data.includes("LnameNull")){
                    lnameBox.classList.add("form-err");
                    lnameHelp.innerHTML = "Last Name must not be blank";
                }else if(data.includes("LnameInvalid")){
                    lnameBox.classList.add("form-err");
                    lnameHelp.innerHTML = "Last Name contains invalid character(s) % * : ; $";
                }

                if(data.includes("CommentNull")){
                    commentBox.classList.add("form-err");
                    commentHelp.innerHTML = "Comment must not be blank";
                }else if(data.includes("CommentInvalid")){
                    commentBox.classList.add("form-err");
                    commentHelp.innerHTML = "Comment contains invalid character(s) % * : ; $";
                }
            }else if(data.includes("Success")){
                successBox.innerHTML = "Your submission was successfully recorded";
                successBox.classList.add("success-box");

                //clear all fields
                var inputElements = document.getElementsByTagName('input');

                for(var i=0; i < inputElements.length; i++) {
                    if(inputElements[i].type == 'text' || inputElements[i].type == 'date')
                        inputElements[i].value = '';

                    if(inputElements[i].type == 'radio')
                        inputElements[i].checked = false;
                }

                document.getElementById('comment').value = '';
            }
        }
    });
});  
</script>