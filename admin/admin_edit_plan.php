<?php
include("connection.php"); 
$plan_name='';
$plan_price='';
$plan_range='';
$edit=false;
if(isset($_GET['edit'])){
    $edit=true;
        $id=$_GET['edit'];
        $select="SELECT * FROM `plans`WHERE `plan_id`=$id";
        $runedite=mysqli_query($connect,$select);
        $fetch=mysqli_fetch_assoc($runedite);
        $plan_name=$fetch['plan_name'];
        $plan_price=$fetch['plan_price'];
        $plan_range=$fetch['plan_range'];
        }
if (isset($_POST['update'])){
$plan_name = $_POST['plan_name'];
$plan_price = $_POST['plan_price'];
$plan_range = $_POST['plan_range'];
$update = "UPDATE `plans` SET `plan_name` = '$plan_name', `plan_price` = '$plan_price', `plan_range` = '$plan_range' WHERE `plan_id` = $id";
$runupdate=mysqli_query($connect,$update);
header ('location:admin_plan.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="./css/payment (2).css">
</head>

<body>
    
                
                    <div class="parent d-flex justify-content-center align-items-center">

                        <div class=" plan1 col-md-6 col-sm-12 col-xs-12">
                            <div class="form px-4 py-3 bg-white customRounded ">
                                <div class="planshadow">
    
                                    <h1>
                                        plan Details
                                    </h1>
    
    
                                 <form action="" class="form" method="POST">
                                    
    
                                    <div class="form-sec">
                                        <label for="">Plan Name </label>
    
                                        
                                          
                                          <input name="plan_name"  placeholder="plan name" value="<?php echo $plan_name ?>" id=""></input> <br><br>
                                    </div>
    
    
                                    <div class="form-sec">
                                        <label for="">Plan Price </label>
    
                                       
                                     
                                     <input name="plan_price"  placeholder="plan price"value="<?php echo $plan_price ?>" id="">
                                    </div>
    
    
                                    <div class="form-sec">
                                        <label for="">Plan Range</label>
    
                                        
                                          <input name="plan_range" value="<?php echo $plan_range ?>" id=""placeholder="plan range">
                                    </div>
    
    
                                    <div class="form-btn">

                                        
                    
                                    
    <button type="submit" name="update">Update</button>
    
                                    </div>
    
    
                                   
    
    
                                 </form>
    
                                    
                                </div>
                             
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
    <script src="./js/payment.js"></script>
</body>

</html>
