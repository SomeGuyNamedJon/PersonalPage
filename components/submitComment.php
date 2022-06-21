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

        echo '<div id="commentBox">
                <label>Comment</label>
                <textarea class="form-input" id="comment" name="comment" rows="10"></textarea>
                <p class="help-block" id="commentHelp"></p>
            </div>';
        
        echo '<button class="btn" id="submitBtn">Submit</button>';
        echo '<div class="ans-box" id="values"></div>';

    echo '</div>'; 
?>

<script>
$('#submitBtn').on('click',function(){
    try{
        var contact = document.querySelector('input[name="contact"]:checked').value;
    }catch(err){
        var contact = null;
    }
    var dataArr = {
        'fname' : document.getElementById('fname').value,
        'lname' : document.getElementById('lname').value,
        'comment' : document.getElementById('comment').value,
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