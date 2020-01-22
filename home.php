
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'includes/head.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    @session_start();
?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <?php
        if(isset($_SESSION['login'])){
            if(!empty($_SESSION['login']) && $_SESSION['login'] == true){
    ?>
        <a style="color:#fff" class="navbar-brand col-sm-3 col-md-2 mr-0"><?php echo $_SESSION['email'] ?></a>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="logouthome.php">Sign out</a>
    <?php }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="login.php">Sign in</a>
    <?php } }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="login.php">Sign in</a>
    <?php } ?>
</nav>

    <div class="form">
        <h3>Welcome to Home Page</h3>

       
        <h5><a href="download.php">Go to Download page</a></h5>

    </div>


</body>
</html>