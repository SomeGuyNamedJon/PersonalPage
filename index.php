<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./assets/css/JetBrains-Mono.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" href="./assets/css/bootstrap-grid.css">
        <script src="assets/js/jquery-3.5.1.js"></script>
	<title>Jonathan Villarreal</title>
    </head>
    <body>
        <div class="container-fluid">
	    <div class="row justify-content-center">
		<div class="col-sm-1">
			<div class="iconContainer">
				<img class="favIcon" src="favicon.ico" />
			</div>
		</div>
		<div class="col-5">
			<h1 class="title">Jonathan Villarreal</h1>
		</div>
            </div>
            <script>
                function updateContent(page){
                    sessionStorage.setItem("page", page);

                    $.ajax({
                        type:'post',
                        url:'./pages/'+page+'.php',
                        success:function(data){
                           
                            document.getElementById("home").classList.remove("active");
                            document.getElementById("school").classList.remove("active");
                            document.getElementById("work").classList.remove("active");
                            document.getElementById("contact").classList.remove("active");
                            document.getElementById("comments").classList.remove("active");
                            
                            document.getElementById(page).classList.add("active");
                            
                            $('#mainContent').html(data);
                        }
                    })
                }

                var currentPage = sessionStorage.getItem("page");

                if(currentPage !== null)
                    updateContent(currentPage);
                else
                    updateContent("home");
                
            </script>

            <?php
                include("./components/navbar.php");
            ?>            
            <div class="container" id="mainContent"></div>
            <br>
            <div class="row">
                    <h4 class="foot">&#169;Jonathan Villarreal 2022 | All rights reserved</h4>
            </div>
        </div>
    </body>
</html>
