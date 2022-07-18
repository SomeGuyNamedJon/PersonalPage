<html>
    <body>
    <script>
        function buildSubBar(page, file){  
            $.ajax({
                type:'post',
                url:'../components/subbar.php',
                data:{
                    active : page,
                    content : file
                },
                success:function(data){
                    $('#subBar').html(data);
                }
            })
        }

        function getLinks(){
            $.ajax({
                type:'post',
                url:'../components/contactLinks.php',
                success:function(data){
                    $('#contactLinks').html(data);
                }
            })
        }

        function updateSubContent(page){
            sessionStorage.setItem("submitPage", page);
            buildSubBar(page, "assets/json/contactSubNav.json");

            $.ajax({
                type:'post',
                url:'../components/submit'+page+'.php',
                success:function(data){
                    $('#subContent').html(data);
                }
            })
        }

        getLinks();

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
        <div id="contactLinks"></div>
    </div>
    </body>
</html>
