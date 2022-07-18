<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./assets/css/main.css">
        <script src="assets/js/jquery-3.5.1.js"></script>
        <script src="https://kit.fontawesome.com/5a3c76bb3d.js" crossorigin="anonymous"></script>
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
                function buildNavBar(page, file){
                    $.ajax({
                        type:'post',
                        url:'components/navbar.php',
                        data:{
                            active : page, 
                            content : file
                        },
                        success:function(data){
                            $('#navBar').html(data);
                        }
                    })
                }

                function updateContent(page){
                    sessionStorage.setItem("page", page);
                    buildNavBar(page, "assets/json/mainNav.json");
                    
                    $.ajax({
                        type:'post',
                        url:'pages/'+page+'.php',
                        success:function(data){
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

            <div class="container" id="navBar"></div>          
            <div class="container" id="mainContent"></div>
            <br>
            <div class="row">
                    <h4 class="foot">&#169;Jonathan Villarreal 2022 | All rights reserved</h4>
            </div>
        </div>
    </body>
</html>
