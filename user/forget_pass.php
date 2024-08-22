<?php
include 'mail.php';
// if(!isset($_SESSION['user_id'])){
//     header("location:.php");
// }
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $_SESSION['email']=$email;
    $select="SELECT * from `users` where `user_email`='$email'";
    $runselect=mysqli_query($connect,$select);
    if(mysqli_num_rows($runselect)>0){
    $rand=rand(10000,100000);
    $msg="Hello your otp is $rand";

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
header("location:otp.php");

    }else{
    $error_msg= "email not found";
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/forget.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

<div class="content">
        
        <div class="main">

            <div class="verification">
                <form  method="POST" action="">
                    <div class="img-div">
                    <img src="./images/forget.jpeg" class="img">
                    </div>
                    <h1>Change Password</h1>
                    <p class="p">Please type the Your Email</p>
                    <br><br>
                    <div class="inputs">
                    <input name="email" type="email" placeholder="info@example.com" required class="input">
                      
                    </div>
                    <?php if(isset($error_msg)) { ?>
                <p>
                 error:  <?php error: echo"$error_msg" ?>
                </p>
                <?php } ?>
                    <button type="submit" name="submit" class="btn">Send</button>

                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

