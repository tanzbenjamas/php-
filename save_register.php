<?php
  $conn = mysqli_connect("localhost", "root", "123321123", "member");

  if(mysqli_connect_error()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

    date_default_timezone_set('Asia/Bangkok');
    if(isset($_POST['submit'])){

        $checkemail = $_POST['email'];
        $checkphone = $_POST['phone'];
        $sql = "SELECT * FROM users WHERE email='$checkemail' ";
        $objQuery = mysqli_query($conn,$sql)or die(mysqli_error( $conn));

        $sql1 = "SELECT * FROM users WHERE phone ='$checkphone'";
        $objQuery1 = mysqli_query($conn,$sql1)or die(mysqli_error( $conn));

        if ($objQuery->num_rows > 0) {
            $message = "Email already in use!";
            echo ("<script type='text/javascript'>window.alert('$message');window.location.href='register.php';</script>");
        }else if($objQuery1->num_rows > 0){
            $message = "Phone Number already in use!";
            echo ("<script type='text/javascript'>window.alert('$message');window.location.href='register.php';</script>");
        }else{
            if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $savetime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO users (firstname, lastname, email, phone, savetime)
                VALUE ('$firstname','$lastname','$email','$phone','$savetime')";
                if ($conn->query($sql) === TRUE) {
                 
                    $_SESSION['email'] = $email;
                    header("Location: login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();

            }else {
                echo "No input";
            }
        }
    }

    
  
?>