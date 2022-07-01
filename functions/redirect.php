# Function long depreacted, just keep around for refernce
<?php
    function redirect($uri)
    { ?>
        <script type="text/javascript">
            document.location.href="<?php echo $uri; ?>";
        </script>
    <?php die;}
?>
