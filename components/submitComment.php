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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M377.7 338.8l37.15-92.87C419 235.4 411.3 224 399.1 224h-57.48C348.5 209.2 352 193 352 176c0-4.117-.8359-8.057-1.217-12.08C390.7 155.1 416 142.3 416 128c0-16.08-31.75-30.28-80.31-38.99C323.8 45.15 304.9 0 277.4 0c-10.38 0-19.62 4.5-27.38 10.5c-15.25 11.88-36.75 11.88-52 0C190.3 4.5 181.1 0 170.7 0C143.2 0 124.4 45.16 112.5 88.98C63.83 97.68 32 111.9 32 128c0 14.34 25.31 27.13 65.22 35.92C96.84 167.9 96 171.9 96 176C96 193 99.47 209.2 105.5 224H48.02C36.7 224 28.96 235.4 33.16 245.9l37.15 92.87C27.87 370.4 0 420.4 0 477.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 420.4 420.1 370.4 377.7 338.8zM176 479.1L128 288l64 32l16 32L176 479.1zM271.1 479.1L240 352l16-32l64-32L271.1 479.1zM320 186C320 207 302.8 224 281.6 224h-12.33c-16.46 0-30.29-10.39-35.63-24.99C232.1 194.9 228.4 192 224 192S215.9 194.9 214.4 199C209 213.6 195.2 224 178.8 224h-12.33C145.2 224 128 207 128 186V169.5C156.3 173.6 188.1 176 224 176s67.74-2.383 96-6.473V186z"/></svg>
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
                window.scrollTo(0,0);

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