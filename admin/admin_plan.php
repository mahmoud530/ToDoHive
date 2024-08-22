<?php
include 'connection.php';
$SELECT= " SELECT * FROM `plans`  ";
$run = mysqli_query($connect, $SELECT);
if(isset($_GET['delete'])){
$id=$_GET['delete'];
$delete_query="DELETE FROM `plans` WHERE `plan_id`=$id";
$run_delete=mysqli_query($connect,$delete_query);
header("location:admin_plan.php");
}
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($run as $data){?>
                <tr>
                
                   <td><?php echo $data['plan_name']?></td>
                   <td><?php echo $data['plan_price']?></td>
                   <td><?php echo $data['plan_range']?></td>
                  <td> <a href="admin_plan.php?delete=<?php echo $data[ 'plan_id']?>">delete </a></td>
                   <a href="admin_edit_plan.php?edit=<?php echo $data['plan_id']?>">edit</a>
                    </tr>
               <?php } ?>
        </tbody>
    </table>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <button class="btnn"><a href="add_plan.php">
            add
            </a>
        </button>
        <!-- first card -->
        <?php foreach($run as $data){?>

        <div class="card" style="width: 18rem;">


            <div class="card-body">
                <div class="card-content">
                    <h5 class="card-title"><?php echo $data['plan_name']?></h5>
                    <h4><?php echo $data['plan_price']?>
                        <div class="month">/month</div>
                </div>
                </h4>

                <p class="card-text">this plan range is <?php echo  $data['plan_range']?></p>

                    <div class="btns">
                        <div class="text-center">
                            <button class="sub-btn"> <a href="admin_edit_plan.php?edit=<?php echo $data['plan_id']?>">Edit</a></button>
                        </div>
                        <div class="text-center">
                            <button class="sub-btn"> <a href="admin_plan.php?delete=<?php echo $data[ 'plan_id']?>">Delete</a></button>
                        </div>
                    </div>
            </div>
        </div>
        <?php } ?>

        
    </section>
</body>
<style>
 .btns{
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
 }
 .sub-btn{
    width: 80px;
 }
</style>
</html>