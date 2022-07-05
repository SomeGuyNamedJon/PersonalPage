<html>
    <body>
    <script>
        function updateSubBar(page){  
            $.ajax({
                type:'post',
                url:'../components/subbar.php',
                data:{active : page},
                success:function(data){
                    $('#subBar').html(data);
                }
            })
        }

        function updateSubContent(page){
            sessionStorage.setItem("submitPage", page);
            updateSubBar(page);

            $.ajax({
                type:'post',
                url:'../components/submit'+page+'.php',
                success:function(data){
                    $('#subContent').html(data);
                }
            })
        }

        var currentPage = sessionStorage.getItem("submitPage");

        if(currentPage !== null)
            updateSubContent(currentPage);
        else
            updateSubContent("Comment");
        
    </script>
    <br>
    <div id="container">
        <div id="subBar"></div>    
        <div id="subContent"></div>
        <?php
            include("../components/contactLinks.php");
        ?>
    </div>
    </body>
</html>
