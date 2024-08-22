<?php
// include("connection.php");
include("sign_mail.php");
// $error_msg="";
$name="";
$email="";
$password="";
$confirm_pass="";
$phone="";
if(isset($_POST['submit'])){  
    $name=$_POST['user_name'];
    $email=$_POST['user_email'];
    $password=$_POST['user_password'];
    $confirm_pass=$_POST['confirm_pass'];
    $passwordhashing=password_hash($password , PASSWORD_DEFAULT);
    $phone=$_POST['phone'];
    $lowercase=preg_match('@[a-z]@',$password);
    $uppercase=preg_match('@[A-Z]@',$password);
    $numbers=preg_match('@[0-9]@',$password);
    $select="SELECT * FROM `users` WHERE `user_email` ='$email' ";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);
    if(empty($name)||empty($email)||empty($password)||empty($comfirm_pass)||empty($phone)){
      $error_msg= " please fill all required data ";
    
    }if($rows>0){
        $error_msg="this email is already taken";
    }elseif($lowercase<1 || $uppercase <1||$numbers<1){
         $error_msg="password must contain at least 1 uppercase , 1 lowercase and number";
    }elseif($password !=$confirm_pass){
        $error_msg= "password doesn't match confirmed password";
    }elseif(strlen($phone)!=11){
         $error_msg="please enter a valid phone number";
    }else{
        $_SESSION['user_name']=$name;
        $_SESSION['user_email']=$email;
        $_SESSION['password']=$passwordhashing;
        $_SESSION['phone']=$phone;
            $rand=rand(10000,100000);
            $msg="hello,your otp is $rand";
                        // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $mail->setFrom('maloka.elhalawany@gmail.com', 'ToDoHive');          //sender mail address , website name
            $mail->addAddress($email);      //reciever mail address
            $mail->isHTML(true);                               
            $mail->Subject = 'Activation code';             //mail subject
            $mail->Body=($msg);                  //mail content
            $mail->send(); 
                   //php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
                   $_SESSION['otp']=$rand;
$_SESSION['times']=0;
            header("location:sign_otp.php");
            
    // $insert="INSERT INTO `users` VALUES(NULL,'$name','$email','$passwordhashing', '$phone','1' ,NULL, NULL)";
    // $run_insert=mysqli_query($connect,$insert);
    // echo "data added succesfully";
     
    }
}
?>
                <!-- <button type="submit"  name="submit">Sign UP</button> -->
                <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <!-- css linking -->
    <link rel="stylesheet" href="./css/signup.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rancho&display=swap"
        rel="stylesheet">
    <!-- boot strap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="main_cont">

        <div class="photo_main">

            <img class="photo" src="./images/signup.jpg" alt="">
        </div>

        <div class="main">
            <h1>SignUp</h1>
            <form class="form" method=POST>
                <!-- user name -->
                <label for="UserName">UserName:</label>
                <input type="text" value="<?php echo $name?>" name="user_name" id="UserName" placeholder="Enter Your UserName" required>
                <!-- email -->
                <label for="Email">Email:</label>
                <input type="email" value="<?php echo $email?>" name="user_email" id="Email" placeholder="Enter Your E-mail" required>
                <!-- pass -->

                <label for="pass">Password:</label>

                <div class="icon">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>


                </div>

                <input type="password" class="pass" value="<?php echo $password?>" name="user_password" id="pass" placeholder="Enter Your Password" required>
                <!-- pass icon -->





                <!-- confirm password -->
                <label for="confirm">Confirm Password:</label>
                <div class="icon1">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>


                </div>
                <input type="password" class="pass" value="<?php echo $password?>" name="confirm_pass" id="confirm" placeholder="Confirm Your Password" required>
                <!-- phone number -->
                <label for="phone">Phone Number:</label>


                <input type="number" value="<?php echo $phone?>" name="phone" id="user_phone" placeholder="+02" required>


                <a href="./login.php" class="login-btn">Have An Account ?</a>
                <?php if(isset($error_msg)) { ?>
                <p>
                 error:  <?php error: echo"$error_msg" ?>
                </p>
                <?php } ?>
                <!-- button -->


                <button class="zorar" type="submit" name="submit">Sign Up</button>

            </form>
        </div>
    </div>

    <!-- boot strap js -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
