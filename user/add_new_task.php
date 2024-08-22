 
<?php
include 'connection.php';
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
 $user_id=$_SESSION['user_id'];
$pid=$_SESSION['project_id'];
$sprint=$_SESSION['sprint_id']=2;
$sel="SELECT * FROM `projects_members` JOIN `users` ON `users`.`user_id` = `projects_members`. `user_id` WHERE `project_id`= $pid ";
$run_sel=mysqli_query($connect,$sel);
// $project_members="SELECT * FROM `project_members`";

// $run_a=mysqli_query($connect,$project_members);

$category="SELECT * FROM `category`";

$run_c=mysqli_query($connect,$category);

$priority="SELECT * FROM `priority`";
$run_p=mysqli_query($connect,$priority);
if(isset($_POST['submit'])){
    $task_name=$_POST['name'];
    $description=$_POST['description'];
    $deadline=$_POST['deadline'];
    $members=$_POST['members'];
    $category=$_POST['category'];
    $pri=$_POST['priority'];
    $insert="INSERT INTO `tasks` VALUES (NULL, '$task_name','$description','$deadline','$user_id','$members','1','$category','$pri',$sprint)";
    $run_insert=mysqli_query($connect,$insert);
    header("location:details_task.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>case01</title>
</head>
<body>
        <h1>ADD NEW TASK</h1> 
<form method="post" enctype="multipart/form-data">

     <label for="name">Task Name</label> 
     <input id="name" type="text" placeholder="TYPE THE NAME HERE!"name="name">

    <label for="Description"> Description</label>
     <input id="description" type="text" placeholder="DESCRIPTION" name="description">

    <label for="deadline">Deadline</label>
    <input id="deadline" type="date" placeholder="deadline" name="deadline">


    <select name="members" id="">
        <?php foreach ($run_sel as $data){ ?>
            <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
      <?php  } ?>
    </select>
    <select name="priority" id="">
        <?php foreach ($run_p as $data){ ?>
            <option value="<?php echo $data ['priority_id'] ?>"><?php echo $data ['priority_name']?></option>
      <?php  } ?>
    </select>
    <select name="category" id="">
        <?php foreach ($run_c as $data){ ?>
            <option value="<?php echo $data ['category_id'] ?>"><?php echo $data ['category_name']?></option>
      <?php  } ?>
    </select>


    
    <button type="submit" class="submit" name="submit">ADD</button>
</form>
</html>