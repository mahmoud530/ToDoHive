<?php
include("connection.php"); 
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
$tid=4;


// if(isset($_GET['edit'])){  comment until tarbeet
//     $tid=$_GET['edit'];

$select="SELECT * FROM `tasks`
JOIN `status` ON `status`.`status_id` =`tasks`.`status_id`
JOIN `priority` ON `priority`.`priority_id` =`tasks`.`priority_id`
 WHERE `task_id` =$tid";
$run=mysqli_query($connect,$select);
$fetch=mysqli_fetch_assoc($run);


$status=$fetch['status_id'];
$statusname=$fetch['status_name'];

$proirity=$fetch['priority_id'];
$priorityname=$fetch['priority_name'];

// }
$allstatus="SELECT * FROM `status`";
$runstatus=mysqli_query($connect,$allstatus);

$allproirity="SELECT * FROM `priority`";
$runpri=mysqli_query($connect,$allproirity);


if(isset($_POST['submit'])) {
$select_status=$_POST['status'];
$select_priority=$_POST['priority'];

$update="UPDATE `tasks` SET `status_id` = $select_status , `priority_id` = $select_priority";
$runupdate= mysqli_query($connect,$update);

header("location:edit.php");

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">

    <label for="">Status :<?php  echo $statusname ?></label> <br>
    <select name="status" id="">
       <?php foreach ($runstatus as $data) { ?>
        <option value="<?php echo $data['status_id'] ?>"> <?php echo $data ['status_name'] ?> </option>
       <?php } ?>
    </select> <br><br>



    <label for="">Priority:<?php  echo $priorityname ?></label> <br>
    <select name="priority" id="">
       <?php foreach ($runpri as $data) { ?>
        <option value="<?php echo $data['priority_id'] ?>"> <?php echo $data ['priority_name'] ?> </option>
       <?php } ?>
    </select>  <br>

    <button type="submit" name="submit">Update</button>

    </form>
</body>
</html>