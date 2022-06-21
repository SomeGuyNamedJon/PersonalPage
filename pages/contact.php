<html>
    <body>
    <script>
        function updateSubContent(page){
            sessionStorage.setItem("submitPage", page);

            document.getElementById("CommentForm").classList.remove("active");
            document.getElementById("InfoForm").classList.remove("active");
            
            document.getElementById(page+"Form").classList.add("active");

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
        <?php
            include("../components/subbar.php");
        ?>    
        <div id="subContent"></div>
        <?php
            include("../components/contactLinks.php");
        ?>
    </div>
    </body>
</html>
