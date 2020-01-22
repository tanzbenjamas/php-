<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    
</head>
<body>

    <?php
        $conn = mysqli_connect("localhost", "root", "123321123", "member");

        if(mysqli_connect_error()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
      session_start();

      if(isset($_POST['email'])) {
         
            $email = stripcslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($conn, $email);
            $phone = stripcslashes($_REQUEST['phone']);
            $phone = mysqli_real_escape_string($conn, $phone);

            $query = "SELECT * FROM users WHERE email ='$email' AND phone = '$phone' ";


        $result = mysqli_query($conn , $query) or dir(mysql_error());
        if ($result->num_rows > 0) {
        while($row1 = mysqli_fetch_array($result)){
            $_SESSION['login'] = true ;
            $_SESSION['id'] = $row1['id'];
            $_SESSION['email'] = $row1['email'];
            header("Location: home.php");
        }
        }else {
            echo "
                <div class=''>
                    <h1> Not found Account </h1>
                    <br>Click here to <a href='login.php'>Login</a>
                </div>";
        }

    }else {

?>
      <form action="" method="post" class="login-form" name ="login">
        <h1>Sign in</h1>
        <div class="txtb">
        <input type="email" name ="email" require>
        <span data-placeholder="E-mail"></span>
        </div>

        <div class="txtb">
        <input type="text" name ="phone"  require>
        <span data-placeholder="Phone Number"></span>
        </div>

        <input type="submit" class="logbtn" name ="login" value="Sign in" >     

        <div class="bottom-text">
        Don't have account ? <a href="register.php">Create an account here.</a>
        </div>

    </form>
    <?php }  ?>

    <script type="text/javascript">
      $(".txtb input").on("focus",function(){
        $(this).addClass("focus");
      });

      $(".txtb input").on("blur",function(){
        if($(this).val() == "")
        $(this).removeClass("focus");
      });

      </script>
    
</body>
</html>