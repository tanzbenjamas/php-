<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="script/validation.min.js"></script>



    
</head>
<body>
<div class ="form">
    <h1>Sign up</h1>
    
    <form id="registration" action="/member/save_register.php" method="post" class ="signup">
        <input type="text" id = "firstname" name ="firstname" minlength="2" placeholder="First Name" oninvalid="this.setCustomValidity('Please Enter valid First Name')" oninput="setCustomValidity('')"  required />
        <span>(required, at least 2 characters)</span>
        <input type="text" id = "lastname"name ="lastname" minlength="2" placeholder="Last Name" oninvalid="this.setCustomValidity('Please Enter valid Last Name')" oninput="setCustomValidity('')"   required />
        <span>(required, at least 2 characters)</span>
        <input type="email" id="email" name ="email" placeholder="E-mail" oninvalid="this.setCustomValidity('Please Enter valid E-mail')" oninput="setCustomValidity('')"  required />
        <span>(Example E-mail : example@gmail.com)</span>
        <input type="text" id = "phone" name ="phone" placeholder="Phone Number" minlength="5" oninvalid="this.setCustomValidity('Please Enter valid Phone Number')" oninput="setCustomValidity('')"  required />
        <span>(required, at least 5 characters , Example : 0222222222)</span>
        <input type="submit" name ="submit" value="Sign up" >
    </form>
    </div>
    </body>
</html>

