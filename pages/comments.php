<script src="assets/js/jquery-3.5.1.js"></script>

<br><div id="output" class="container-fluid"></div>

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