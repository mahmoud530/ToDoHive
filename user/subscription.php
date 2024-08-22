<?php
include "./connection.php";
$user_id=$_SESSION['user_id'];
if(isset($_POST['submit'])){
     $plan_name= $_POST['plan_name'];
     $plan_price= $_POST['plan_price'];
     $plan_range= $_POST['plan_range'];
}

$select="SELECT * from `plans`";
$runSelect=mysqli_query($connect, $select);

$select_upgrade="SELECT * FROM `users` WHERE user_id=$user_id";
$run_upgrade=mysqli_query($connect,$select_upgrade);
$fetch=mysqli_fetch_assoc($run_upgrade);
$plan=$fetch['plan_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>subscription</title>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- css link -->
    <link rel="stylesheet" href="./css/subscription.css">
    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- bootstrap link -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <section class="container-cards">
        <?php foreach ($runSelect as $key) { ?>
            <?php if($plan!=$key['plan_id']) { ?> 
        <div class="card" style="width: 18rem;">


            <div class="card-body">
                <div class="card-content">
                    <h5 class="card-title" name="plan_name"><?php echo $key['plan_name']?></h5>
                    <h4 name="plan_price">$<?php echo $key['plan_price']?>
                    <h4 name="plan_range"> Up to <?php echo $key['plan_range']?></h4>
                        <div class="month" >/month</div>
                </div>
                </h4>

            
                <div class="text-center">

                    <button class="sub-btn"> <a href="paymentt.php?submit=<?php echo $key['plan_id']?>">subscribe</a></button>

               
                </div>
            </div>
        </div>
        <?php }} ?>
    </section>
</body>

</html>