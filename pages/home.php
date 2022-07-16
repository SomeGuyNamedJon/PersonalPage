<html>
    <body>
    <script>
        $.ajax({
            type:'post',
            url:'../functions/load_home.php',
            success:function(data){
                $('#subContent').html(data);
            }
        })
    </script>
    <br>
    <div id="container">
        <div id="subContent"></div>
    </div>
    </body>
</html>
