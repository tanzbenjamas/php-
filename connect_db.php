<?php
error_reporting( error_reporting() & ~E_NOTICE);
$servername = "localhost";
$username = "root";
$password = "123321123";
$dbname = "member";
$conn = new mysqli($servername, $username, $password, $dbname);

if(mysqli_connect_errno())
{
echo "Database Contect Failed :" .mysqli_connect_errno();
exit();
}
mysqli_set_charset($conn, "utf8");
?>