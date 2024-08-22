<?php
include("connection.php");
// if(!isset($_SESSION['user_id'])){
//     header("location:login.php");
// }

$error_msg="";
if(isset($_POST['login'])){
    $email=$_POST['user_email'];
    $password=$_POST['user_password'];
    $select="SELECT * FROM `users` WHERE `user_email`='$email'";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);

    if($rows>0){
        $fetch=mysqli_fetch_assoc($run_select);
        $hashed_password=$fetch['user_password'];
            
         if(password_verify($password,$hashed_password)){
            $user_id=$fetch['user_id'];
            $_SESSION['user_id']=$user_id;
            //change header!!!
           header("location:dashboard2");
        //    echo "data";
        }else{
            $error_msg="password incorrect";
           echo" password incorrect ";
    }
    }else{
        $error_msg="incorrect email ";
       echo" incorrect email ";
    
}}
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <!-- css -->
    <link rel="stylesheet" href="./css/login.css">
    <!-- font awesome link -->  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <div class="main-cont">
        <div class="main">
            <div class="text-center">
                <img class="image " src="images/Login-amico.png" alt="logo">

            </div>
            <h2>Login</h2>
            <form method="post">
                <div class="box">
                    <!-- email -->
                    <label class="label" for="email">Email</label>

                    <input type="email"name="user_email" placeholder="email" required>
                    <!-- passsword -->
                    <label class="label" for="password">Password</label>
                    <div class="icon">
                        <input type="password"  name="user_password" placeholder="password" required>
                        <!-- pass icon -->
                        <i class="fa-solid fa-eye-slash"></i>
                    </div>
                    <!-- button -->
                    <button class="d" name="login" type="submit">Log In</button>

                </div>
            </form>
        </div>
    </div>

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script> -->
</body>

</html>