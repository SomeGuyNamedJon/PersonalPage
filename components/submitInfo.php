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
                        <label for="contact-Email">
                        <input class="form-radio" type="radio" id="contact-Email" name="contact" value="Email">                      
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z"/></svg>
                        </label>
                    </div>
                    <div class="col" align="center">
                        <label for="contact-Phone">
                        <input class="form-radio" type="radio" id="contact-Phone" name="contact" value="Phone">                      
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/></svg>
                        </label>
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