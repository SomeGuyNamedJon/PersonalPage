<script src="assets/js/jquery-3.5.1.js"></script>
<?php
    echo '<br><div id="output"></div>';
?>
<script>
    function loadComments(){
        $.ajax({
            url: "./functions/load_comments.php",
            type: "POST",
            success:function(data){$('#output').html(data);}
        });
    }
    loadComments();
    setInterval(() => {
        loadComments();
    }, 5000);
</script>