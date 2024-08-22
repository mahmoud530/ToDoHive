<?php
include("connection.php");
// $error_msg="";
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
            $role_id=$fetch['role_id'];
            $_SESSION['role_id']=$role_id;
            $plan_id=$fetch['plan_id'];
            if($plan_id){
            
            $select_plan="SELECT * FROM `plans` where `plan_id` = $plan_id ";
            $run_plan=mysqli_query($connect,$select_plan);
$data=mysqli_fetch_Assoc($run_plan);
            $_SESSION['plan_range']=$data['plan_range'];
            
            
            }
            //change header!!!
           header("location:dashboard2.php");
        //    echo "data";
        }else{
            $error_msg="password incorrect";
        //    echo" password incorrect ";
    }
    }else{
        $error_msg="incorrect email ";
       }}
    
// header("location:dashboard.php");

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

        <div class="photo_main">
            <img class="photo" src="./images/login-amico.png" alt="">
        </div>

        <div class="main">

            <h2>Login</h2>
            <form class="form" method="POST">
                <!-- email -->
                <label for="Email">Email:</label>
                <input type="email" name="user_email" id="Email" placeholder="Enter Your E-mail" required>
                <!-- pass -->

                <label for="pass">Password:</label>

                <div class="icon">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>


                </div>

                <input type="password" name="user_password" id="pass" class="pass" placeholder="Enter Your Password" required>
                <!-- pass icon -->

                 <a href="./forget_pass.php" class="forget"> Forget Password ?</a>
                 <?php if(isset($error_msg)) { ?>
                <p>
                   error: <?php error: echo"$error_msg" ?>
                </p>
                <?php } ?>
                <!-- button -->
                <button class="zorar" type="submit" name="login">Login</button>

            </form>
        </div>
    </div>

    <script>
        const btns = document.querySelectorAll('.fa-eye'); 
const passwords = document.querySelectorAll('.pass'); 

btns.forEach((btn, index) => {
  btn.addEventListener('click', () => {
    const password = passwords[index]; 
    if (password.type === 'password') {
      password.type = 'text';
      btn.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      password.type = 'password';
      btn.classList.replace('fa-eye-slash', 'fa-eye');
    }
  });
});
    </script>

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script> -->
</body>


</html>
