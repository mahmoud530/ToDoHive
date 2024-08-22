
<?php

include 'connection.php';
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
$error="";
$id=$_SESSION['user_id'];
// $pid=6;
// $sprint=1;
$sprint_end="";
$sprint_start="";
$sprint_name="";
$edit=false;

if(isset($_GET['sprint_id'])){
    $edit=true ;
$pid=$_GET['pid'];
$sprint_id=$_GET['sprint_id'];
$select_sprint="SELECT * FROM `sprints` WHERE `sprint_id` =$sprint_id";
$run_sprint=mysqli_query($connect,$select_sprint);
$fetch=mysqli_fetch_assoc($run_sprint);
$sprint_name=$fetch['sprint_name'];
$sprint_start=$fetch['sprint_start'];
$sprint_end=$fetch['sprint_end'];
// $sel="SELECT * FROM `projects_members`  JOIN `users` ON `users`.`user_id` = `projects_members`. `user_id` WHERE `project_id`= $pid ";
// $run_sel=mysqli_query($connect,$sel);
if(isset($_POST['update'])){
    
    $sprint_name=$_POST['name'];
    $sprint_start=$_POST['startdate'];
    $sprint_end=$_POST['enddate'];
    $sprint_start1=strtotime($sprint_start);
    $sprint_end1=strtotime($sprint_end);
    $time=strtotime("yesterday");
    $end_time=strtotime("+14");
$diff=$sprint_end1 - $sprint_start1;
$diff=$diff / (60*60*24);
if($diff<14 and $diff>31){
    $error="choose between 14 and 31 days";
    
}elseif($sprint_start1 <$time){
    $error="choose current date";
    
}elseif($sprint_end1 <$end_time){
    $error="choose more than 13 days from today";
    
}elseif(empty($sprint_name)){
    $error="please,put the name";
}
else{
    // $insert="U INTO `sprints` VALUES (NULL, '$sprint_name','$sprint_start','$sprint_end',$pid)";
    $insert="UPDATE `sprints` SET  `sprint_name` = '$sprint_name' , `sprint_start`='$sprint_start' ,`sprint_end`='$sprint_end'  WHERE `sprint_id`=$sprint_id";
    $run_insert=mysqli_query($connect,$insert); 
    header("location:project_details.php?project_id=$pid");
}
}



} 
if(isset($_GET['pid'])){
    $pid=$_GET['pid'];
if(isset($_POST['add'])){
    $sprint_name=$_POST['name'];
    $sprint_start=$_POST['startdate'];
    $sprint_end=$_POST['enddate'];
    $sprint_start1=strtotime($sprint_start);
    $sprint_end1=strtotime($sprint_end);
    $time=strtotime("yesterday");
    $end_time=strtotime("+14");
$diff=$sprint_end1 - $sprint_start1;
$diff=$diff / (60*60*24);
if($diff<14 and $diff>31){
    $error="choose between 14 and 31 days";
    
}elseif($sprint_start1 <$time){
    $error="choose current date";
    
}elseif($sprint_end1 <$end_time){
    $error="choose more than 13 days from today";
    
}elseif(empty($sprint_name)){
    $error="please,put the name";

}
else{
    $insert="INSERT INTO `sprints` VALUES (NULL, '$sprint_name','$sprint_start','$sprint_end',$pid)";
    $run_insert=mysqli_query($connect,$insert); 
    header("location:project_details.php?project_id=$pid");
}
}
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sprint</title>
    <!-- css link -->
 <link rel="stylesheet" href="./css/addsprint.css"> 
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body class="body" >
    <div class="container">
        <div class="main">
            <?php if($error){ ?>
            <?php echo $error ; ?>
           <?php } ?>
            <form  class="form" method="POST">
                <div class="heading">Add New Sprint</div>
                <input  class="input" type="text" name="name" id="name" value="<?php echo $sprint_name ?>"
                    placeholder="name">
                 
                <input  class="input" type="date" name="startdate" id="startdate" value="<?php echo $sprint_start ?>">
               
                <input  class="input" type="date" name="enddate" id="enddate" value="<?php echo $sprint_end ?>">
                <?php if($edit){ ?>
                    <button type="submit" class="login-button" class="submit" name="update">update</button>
   <?php }else{ ?>
                    <button type="submit" class="login-button" class="submit" name="add">submit</button>
           <?php }?>
                    </form>

        </div>

    </div>







    <!-- boot strap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

</body>

</html>
