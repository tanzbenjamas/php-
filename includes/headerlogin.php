<?php
    @session_start();
?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <?php
        if(isset($_SESSION['login'])){
            if(!empty($_SESSION['login']) && $_SESSION['login'] == true){
    ?>
        <a style="color:#fff" class="navbar-brand col-sm-3 col-md-2 mr-0"><?php echo $_SESSION['email'] ?></a>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="logout.php">logout</a>
    <?php }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="login.php">login</a>
    <?php } }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="login.php">login</a>
    <?php } ?>
</nav>