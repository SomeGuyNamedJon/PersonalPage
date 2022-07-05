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
                function updateNavBar(page){
                    $.ajax({
                        type:'post',
                        url:'components/navbar.php',
                        data:{active : page},
                        success:function(data){
                            $('#navBar').html(data);
                        }
                    })
                }

                function updateContent(page){
                    sessionStorage.setItem("page", page);
                    updateNavBar(page);
                    
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

            <div id="navBar"></div>          
            <div class="container" id="mainContent"></div>
            <br>
            <div class="row">
                    <h4 class="foot">&#169;Jonathan Villarreal 2022 | All rights reserved</h4>
            </div>
        </div>
    </body>
</html>
