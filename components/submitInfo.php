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
    
        echo '<div id="emailBox">
                <label>Email</label>
                <input class="form-input" type="text" id="email" name="email">
                <p class="help-block" id="emailHelp"></p>
            </div>';
    
        echo '<div id="phoneBox">
                <label>Phone Number</label>
                <input class="form-input" type="text" id="phone" name="phone">
                <p class="help-block" id="phoneHelp"></p>
            </div>';
    
        echo '<div id="dobBox">
                <label>Date of Birth</label>
                <input class="form-input" type="date" id="dob" name="dob">
                <p class="help-block" id="dobHelp"></p>
            </div>';
    
        echo '<div id="contactBox">
                <label>Prefered Contact Method</label>
                <div class="row">
                    <div class="col" align="center">
                        <input class="form-radio" type="radio" id="contact-Email" name="contact" value="Email">
                        <label for="contact-Email">Email</label>
                    </div>
                    <div class="col" align="center">
                        <input class="form-radio" type="radio" id="contact-Phone" name="contact" value="Phone">
                        <label for="contact-Phone">Phone</label>
                    </div>
                </div>
                <p class="help-block" id="contactHelp"></p>        
            </div>';

        echo '<div id="commentBox">
                <label>Comment (optional)</label>
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
$('#submitBtn').on('click',function(){
    try{
        var contact = document.querySelector('input[name="contact"]:checked').value;
    }catch(err){
        var contact = null;
    }
    var dataArr = {
        'fname' : document.getElementById('fname').value,
        'lname' : document.getElementById('lname').value,
        'email' : document.getElementById('email').value,
        'phone' : document.getElementById('phone').value,
        'dob' : document.getElementById('dob').value,
        'contact' : contact,
        'comment' : document.getElementById('comment').value,
    }
    $.ajax({
        type:'post',
        url:'../functions/processContact.php',
        data: dataArr,
        success:function(data){
            //Help and form boxes
            var successBox = document.getElementById("successBox");
            var fnameBox = document.getElementById("fnameBox");
            var fnameHelp = document.getElementById("fnameHelp");
            var lnameBox = document.getElementById("lnameBox");
            var lnameHelp = document.getElementById("lnameHelp");
            var emailBox = document.getElementById("emailBox");
            var emailHelp = document.getElementById("emailHelp");
            var phoneBox = document.getElementById("phoneBox");
            var phoneHelp = document.getElementById("phoneHelp");
            var commentBox = document.getElementById("commentBox");
            var commentHelp = document.getElementById("commentHelp");
            var contactBox = document.getElementById("contactBox");
            var contactHelp = document.getElementById("contactHelp");
            var dobBox = document.getElementById("dobBox");
            var dobHelp = document.getElementById("dobHelp");

            fnameBox.classList.remove("form-err");
            lnameBox.classList.remove("form-err");
            emailBox.classList.remove("form-err");
            phoneBox.classList.remove("form-err");
            commentBox.classList.remove("form-err");
            contactBox.classList.remove("form-err");
            dobBox.classList.remove("form-err");
            successBox.classList.remove("success-box");

            fnameHelp.innerHTML = "";
            lnameHelp.innerHTML = "";
            emailHelp.innerHTML = "";
            phoneHelp.innerHTML = "";
            commentHelp.innerHTML = "";
            contactHelp.innerHTML = "";
            dobHelp.innerHTML = "";
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

                if(data.includes("EmailNull")){
                    emailBox.classList.add("form-err");
                    emailHelp.innerHTML = "Email must not be blank";
                }else if(data.includes("EmailInvalid")){
                    emailBox.classList.add("form-err");
                    emailHelp.innerHTML = "Not a valid email";
                }

                if(data.includes("PhoneNull")){
                    phoneBox.classList.add("form-err");
                    phoneHelp.innerHTML = "Phone must not be blank";
                }else if(data.includes("PhoneInvalid")){
                    phoneBox.classList.add("form-err");
                    phoneHelp.innerHTML = "Phone is invalid format";
                }

                if(data.includes("DateNull")){
                    dobBox.classList.add("form-err");
                    dobHelp.innerHTML = "Date of Birth must be a valid date";
                }else if(data.includes("DateInvalid")){
                    dobBox.classList.add("form-err");
                    dobHelp.innerHTML = "Date of Birth must be a date before current date";
                }

                if(data.includes("ContactNull")){
                    contactBox.classList.add("form-err");
                    contactHelp.innerHTML = "Contact Method must be selected";
                }

                if(data.includes("CommentInvalid")){
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