<?php
include "connection.php";
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
$user_id=$_SESSION['user_id'];
if(isset($_GET['submit'])){
    $plan_id=$_GET['submit'];


$select="SELECT * FROM `plans` WHERE $plan_id=`plan_id`";
$run_select=mysqli_query($connect,$select);
$fetch=mysqli_fetch_Assoc($run_select);
$price=$fetch['plan_price'];
$name=$fetch['plan_name'];
$range=$fetch['plan_range'];
}

if(isset($_GET['submit'])){
    $update="UPDATE `users` SET `role_id` = 2 ,`plan_id`= $plan_id WHERE `user_id` = $user_id ";
    $run_update=mysqli_query($connect,$update);
    $_SESSION['plan_range']=$range;
    $_SESSION['role_id']=2;
    // echo "Done";
    // header("location:add_project.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- bootstrab -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="./css/payment1.css">
</head>

<body>
    <div class="big w-100 vh-100 bg-light">
        <div class="main-card d-flex h-100 align-items-center">
            <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 mx-auto">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12 col-xs-12 two-cards">
                        <div class="position-relative">
                            <div class="cardStyle">
                                <div class="text-end"><strong>TD BANK</strong></div>
                                <div class="mt-3 d-flex align-items-center justify-content-between">
                                    <div><img src="./images/ship.png" alt="Chip" width="70" height="70"></div>
                                    <div><img style="transform:rotate(90deg)" src="../images/wifi.png" alt="Chip"
                                            height="24"></div>
                                </div>
                                <div class="fs-4 mt-2 cardFont text-shadow-white" id="visualNumber">0123 4567 8910 1112
                                </div>
                                <div class="row mt-2">
                                    <div class="col"></div>
                                    <div class="col text-shadow-white"><span id="visualMonth">12</span>/<span
                                            id="visualYear">24</span></div>
                                </div>
                                <div class="text-info text-shadow-black"><strong id="visualName">Card Holder
                                        Name</strong>
                                </div>
                            </div>
                            <div class="cardStyle cardBack pt-3">
                                <div class="linear mt-4 p-4 bg-black"></div>
                                <div class="mb-3 bg-white">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-3 bg-white"></div>
                                        <div class="p-3 bg-light"><em id="visualCVV">123</em></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6 col-sm-12 col-xs-12">
                        <div class="form px-4 py-3 bg-white customRounded ">
                            <div class="plan shadow">
                                <h2>Plan Details</h2>
                                <h5>Plan Name:</h5>
                                <p><?php echo $name?> </p>
                                <h5>Plan Price:</h5>
                                <p><?php echo $price?> </p>
                                <h5>Plan Range:</h5>
                                <p><?php echo $range?> </p>
                            </div>
                            <div class="bottom shadow">
                                <h2>Payment Details</h2>
                                <form >
                                    <div class="mt-4 mb-3"><input onkeyup="updateCard(this,'visualNumber')"
                                            onblur="protect(this,4)" type="text" name="cardNumber" id="cardNumber"
                                            placeholder="CARD NUMBER" class="form-control"></div>
                                    <div class="mb-3"><input type="text" onkeyup="updateCard(this,'visualName')"
                                            name="cardholderName" id="cardholderName" placeholder="CARD HOLDER NAME"
                                            class="form-control"></div>
                                    <div class="row">
                                        <div class="col"><input type="text" onkeyup="updateCard(this,'visualMonth')"
                                                placeholder="12" name="month" class="form-control"></div>
                                        <div class="col"><input type="text" onkeyup="updateCard(this,'visualYear')"
                                                placeholder="24" name="year" class="form-control"></div>
                                        <div class="col"><input type="text" onkeyup="updateCard(this,'visualCVV')"
                                                placeholder="CVV" name="year" class="form-control"></div>
                                    </div>
                                    <div class="buttons mt-3 d-flex">
                                        <a href="./add_project.php" class="btnn w-75 me-2"  name="pay">payment</a>
                                        <a href="./subscription.php" class="btn w-25 ms-2 ">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bootstrap js link -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- js -->
    <script src="../js/payment.js"></script>
</body>

</html>