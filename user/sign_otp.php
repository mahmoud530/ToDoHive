<?php
include'connection.php';
if(!isset($_SESSION['times'])){
    header("location:login.php");
}
$_SESSION['times'];
$rand2=$_SESSION['otp'];
if (isset($_POST['submit'])){
    $otp=$_POST['otp'];
    if($rand2==$otp){     
         if($_SESSION['times']<3){
        unset($_SESSION['times']);
                    
        
        $name=$_SESSION['user_name'];
        $email=$_SESSION['user_email'];
        $passwordhashing=$_SESSION['password'];
        $phone=$_SESSION['phone'];
        $insert="INSERT INTO users VALUES(NULL,'$name','$email','$passwordhashing', '$phone','1' ,NULL)";
        $run_insert=mysqli_query($connect,$insert);
        // echo "data added succesfully";
        
        header("location:login.php");
    }else{
        $error_msg="expired otp";
unset($_SESSION['times']);
    header("refresh:2; url=signup.php");
}
    }else{
        $_SESSION['times']++;
        if($_SESSION['times']<3){
            $error_msg="incorrect otp";
        }else{
            $error_msg="expired otp";
            unset($_SESSION['times']);
        header("refresh:2; url=signup.php");
                        
        }
    }
}
?>
 <html>

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OTP</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="./css/forgetpass.css">

    </head>

<body>
    <div class="content">
        
        <div class="main">


            <!-- image -->



            <div class="verification">
                <form  method="POST" action="">
                    <div class="img-div">
                        <img src="./images/Authentication-pana.png" alt="" class="img">
                    </div>
                    <h1>Verification Code</h1>
                    <p class="p">Please type the verification code sent to Email</p>
                    <br><br>
                    <div class="inputs">
                        <input type="text" name="otp" class="input" placeholder="Enter Your OTP">
                      
                    </div>
                    <?php if(isset($error_msg)) { ?>
                <p>
                Error: <?php error: echo"$error_msg" ?>
                </p>
                <?php } ?>
                    <button type="submit" name="submit" class="btn">Verify</button>

                </form>
            </div>



        </div>
    </div>
</body>

</html>