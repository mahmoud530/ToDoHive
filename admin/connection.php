<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database ="case01";

$connect = mysqli_connect($localhost, $username ,$password , $database);

session_start();

if(isset($_POST['logout']))
{
    session_unset();
    session_destroy();
    header("location:login.php");
}

?>