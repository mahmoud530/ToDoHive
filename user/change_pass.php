<?php
include 'connection.php';
if(isset($_POST['submit'])){
     $email=$_SESSION['email'];
     $password=$_POST['pass'];
     $confirm_password=$_POST['confirm_password'];
     $hashed=password_hash($password,PASSWORD_DEFAULT);
     $lowercase=preg_match('@[a-z]@',$password);
     $uppercase=preg_match('@[A-Z]@',$password);
     $numbers=preg_match('@[0-9]@',$password);
     $character=preg_match('@[^\w]@', $password);
     if (strlen($password) < 6) {
          $error_msg = "The password should have at least 6 characters.";
       
      }elseif ($password !=$confirm_password){
        $error_msg="password doesn't match confirm password";
             
      }   elseif ($uppercase<1 ||$lowercase<1 ||$numbers<1 ||$character<1 ){
        $error_msg= "password must contain upeercase, lowercase, number and character ";
              
               }else{
     $update="UPDATE `users` set `user_password`='$hashed' where `user_email`='$email'";
     $ruunupdate=mysqli_query($connect,$update);
     $error_msg= "password change successfully";
     unset($_SESSION['otp']);
     unset($_SESSION['email']);
     header("location:login.php");
}}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/create-pass.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <div class="main-cont">
        <div class="main">
            <div class="text-center">
                <h1>Reset password</h1>

            </div>
            <img class="image " src="images/5c13de1c-fb85-463e-b616-78c71ab57e55.jpeg" alt="logo">

            <form method="POST">
                <div class="box">
                    <label class="label" for="password">Create New password</label>
                    <div class="icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <input name="pass" type="password" placeholder="W@5v7$jjd" required>
                    <label class="label" for="passwoord">Confirm password</label>
                    <input name="confirm_password" type="password" placeholder="password" required>

                    <?php if(isset($error_msg)) { ?>
                <p>
                  <?php echo"$error_msg" ?>
                </p>
                <?php } ?>
                    <button class="d" name="submit" type="submit">Submit</button>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
