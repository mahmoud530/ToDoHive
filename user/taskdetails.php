<?php
include "mail_task.php";

$user_id=$_SESSION['user_id'];
$id=$_SESSION['project_id'];
$sprint_id=$_SESSION['sprint_id'];
if(isset($_GET['details'])){
    $task_id=$_GET['details'];
    $_SESSION['task_id']=$task_id;
}

$selmem="SELECT * FROM projects_members 
JOIN users ON users.user_id = projects_members. user_id WHERE project_id= $id ";
$run_selm=mysqli_query($connect,$selmem);

$sel="SELECT * FROM projects
JOIN users ON users.user_id = projects.user_id
WHERE projects.project_id= $id ";
$run_sel=mysqli_query($connect,$sel);


if(isset($_POST['share_btn'])){
    $share_assignee=$_POST['assignee'];

    $share_update="UPDATE tasks SET assignee=$share_assignee 
    WHERE task_id=$task_id";
    $shareT_run=mysqli_query($connect,$share_update);
    $taskid=$task_id;
        include("mail task.php");

}




    $task_id=$_SESSION['task_id']; 
    $Sel_pri="SELECT * FROM `priority`";
    $run_sel_pri=mysqli_query($connect,$Sel_pri);

    $Sel_stat="SELECT * FROM `status`";
    $run_sel_stat=mysqli_query($connect,$Sel_stat);


    $select="SELECT `tasks`.* , `status`.* , `priority`.* ,`category`.* ,`users`.* ,`mt`.`user_id`AS `ss`,`mt`.`user_email` AS `MM` FROM `tasks`
     JOIN `status` ON `tasks`.`status_id` = `status`.`status_id`
     JOIN `users` ON `tasks`.`assignee` = `users`.`user_id`
     JOIN `users` AS `mt`  ON `tasks`.`reporter` = `mt`.`user_id` 
     JOIN `priority` ON `tasks`.`priority_id` = `priority`.`priority_id`
     JOIN `category` ON `tasks`.`category_id` = `category`.`category_id`
     WHERE `tasks` .`task_id`=$task_id";
    $run=mysqli_query($connect,$select);
    $fetch=mysqli_fetch_assoc($run);
    $taskname=$fetch['task_name'];
    $taskdesc=$fetch['task_description'];
    $deadline=$fetch['deadline'];
    $assignee=$fetch['user_email'];
    $assignee_id=$fetch['assignee'];
    $reporter=$fetch['MM'];
    $reporter_id=$fetch['ss'];
    $STATUS=$fetch['status_name'];
    $priority=$fetch['priority_name'];
    $category=$fetch['category_name'];
 $current_date=strtotime("today");
 $deadline_date=strtotime("$deadline");
if($current_date<$deadline_date){
    $day=$deadline_date-$current_date;
    $day_left=date("d",$day)." days";
}else{
    $day_left="end";
}
if(isset($_POST['add'])){
    if(!empty($_POST['comment'])){
    $text=$_POST['comment'];
    if(($_FILES['image']['name'])){
    $file=$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"./file/".$file);

       $comment_content = trim(mysqli_real_escape_string($connect, $text));
   
       $insert_comment="INSERT INTO `comment` VALUES (NULL, '$text', $user_id,'$file',$task_id)";
       mysqli_query($connect, $insert_comment);
   

       $select_comment="SELECT * FROM `comment` order by `comment_id` desc limit 1";
       $run_comment=mysqli_query($connect,$select_comment);
       $fetch=mysqli_fetch_assoc($run_comment);
       $id=$fetch['comment_id'];

   }else {
// $file=NULL;
       $comment_content = trim(mysqli_real_escape_string($connect, $text));
       if (!empty($comment_content)) {
           $insert_comment="INSERT INTO `comment` VALUES (NULL, '$text', $user_id,NULL,$task_id)";
           mysqli_query($connect, $insert_comment);
       

           $select_comment="SELECT * FROM `comment` order by `comment_id` desc limit 1";
           $run_comment=mysqli_query($connect,$select_comment);
           $fetch=mysqli_fetch_assoc($run_comment);
           $id=$fetch['comment_id'];
       
   }
} } }
$select_view="SELECT * FROM `comment` JOIN `tasks` ON `tasks`.`task_id`= `comment`.`task_id`
JOIN `users` on `users`.`user_id` = `comment`.`user_id`
 where `comment`.`task_id`=$task_id";
$run_view=mysqli_query($connect,$select_view);

     
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete ="DELETE FROM `comment` WHERE `comment_id` = $id";
    $run_delete = mysqli_query($connect , $delete);
    header("location:taskdetails.php");
}
echo "<br>";

$select_share="SELECT * FROM `tasks` WHERE `task_id`=$task_id AND `assignee`=$user_id";
$run_share=mysqli_query($connect,$select_share);
$number=mysqli_num_rows($run_share);
if (isset($_POST['share'])) {
    header("location:share_task.php?task_id=$task_id&&reporter=$assignee_id");
}

if(isset($_POST['edit'])) {
    if(!empty($_POST['status'])){
        if(!empty($_POST['priority'])){
            $select_status=$_POST['status'];
    $select_priority=$_POST['priority'];
    $update="UPDATE `tasks` SET `status_id` = $select_status , `priority_id` = $select_priority WHERE `task_id`=$task_id";
    $runupdate= mysqli_query($connect,$update);
    $error="edit states and priority successfully";
    header("refresh: 2;url=taskdetails.php");
        }else{
            $select_status=$_POST['status'];
            $update="UPDATE tasks SET status_id = $select_status WHERE `task_id`=$task_id";
            $runupdate= mysqli_query($connect,$update);
            $error="edit states  successfully";
            header("location:taskdetails.php");
        }


    }elseif(!empty($_POST['priority'])){
    $select_priority=$_POST['priority'];

        $update="UPDATE tasks SET priority_id = $select_priority  WHERE `task_id`=$task_id";
        $runupdate= mysqli_query($connect,$update);
        $error="edit priority successfully";
        header("location:taskdetails.php");
    }else{
    $error="please select new status and new priority";

    }

}

?>



















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>

    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/taskdetails.css">


</head>

<body>

    <div class="container">
        <div class="header">
            <h1>
                <?php  echo $taskname; ?><i class="fa-regular fa-clock"></i>
                <?php echo $day_left;?>
            </h1>

            <div class="share">
                <?php
        if ($number>0){?>

                <a href="#" onclick="openaddmember()">

                    <i class="fa-solid fa-share-nodes" style="color: blue;"></i>
                </a>
                </form>
                <?php }   ?>

                <a href="./sprint_details.php?project_id=<?php echo $id ." &&sprint_id=".$sprint_id?>"
                    class="options"><i class="fa-solid fa-xmark" style="color: red;"></i></a>

            </div>


        </div>

        <div class="content">
            <div class="description">Description</div>
            <div class="description">
                <?php echo $taskdesc;?>
            </div>


            <div class="sidebar">
                <div class="item">
                    <label>Assignee:
                        <?php echo $assignee; ?>
                    </label>
                </div>
                <div class="item">
                    <label>Reporter:
                        <?php echo $reporter; ?>
                    </label>
                </div>
                <div class="item">
                    <label>Status:
                        <?php  echo $STATUS; ?>
                    </label>
                    <?php if($user_id == $reporter_id OR $user_id==$assignee_id) { ?>
                    <button class="btn"><i class="fa-solid fa-pen-to-square" onclick="openPop1()"></i></button>
                    <?php } ?>
                </div>
                <div class="item">
                    <label>Priorty:
                        <?php echo $priority; ?>
                    </label>
                    <?php if($user_id == $reporter_id OR $user_id==$assignee_id) { ?>
                    <button class="btn"><i class="fa-solid fa-pen-to-square" onclick="openPop2()"></i></button>
                    <?php } ?>
                </div>
                <div class="item">
                    <label>Category:
                        <?php echo $category;?>
                    </label>
                </div>

            </div>


            <form class="comment-section" method="POST" enctype="multipart/form-data">



                <input type="text" placeholder="Enter Your Comment" class="com-inpt" name="comment">

                <div class="add-com">


                    <label for="choose" class="add-btn">Link File <i class="fa-solid fa-link"></i></label>

                    <input type="file" class="file-inpt" id="choose" name="image">
                    <button type="submit" class="add-btn" name="add">Comment</button>
                </div>




            </form>


        </div>



        <div class="comments-section">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name:</th>
                        <th scope="col">Comment</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($run_view as $data) {?>
                    <tr>

                        <td>
                            <?php echo $data['user_name']?>
                        </td>
                        <td>
                            <?php echo $data['text']?>
                        </td>
                        <?php if(isset($data['upload'])){ ?>
                        <td>
                            <?php echo $data['upload']  ?><a href="" Download="<?php echo $data['upload'] ?>"><i
                                    class="fa-solid fa-download" style="color:black; margin-left:20px;"></i></a>
                        </td>
                        <?php } ?>
                        <td>
                            <form method="POST">
                            <?php if($user_id==$data['user_id']){ ?> 
                                <span>
                                    
                                    <a href="taskdetails.php?delete=<?php echo $data['comment_id']?>"><i
                                            class="fa-solid fa-trash" style="color: grey;"></i></a>
                                            
                                </span>
                                <?php } ?>
                        </td>

                    </tr>
                    <?php } ?>

                </tbody>
            </table>


        </div>

        <?php if(!isset($_POST['edit'])) { ?>


        <div id="mainPop1" class="pop-up d-none">

            <div class="container1">
                <i class="fa-solid fa-xmark" onclick="closePop1()"></i>
                <div class="heading">Edit Status</div>
                <form class="form" method="post">


                    <div class="selection">

                        <select name="status" id="status" class="status">
                            <option value="NULL">ٍSelect The Status</option>
                            <?php foreach($run_sel_stat as $stats){ ?>
                            <option value="<?php echo $stats['status_id'] ?>">
                                <?php echo $stats['status_name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="login-button" name="edit" onclick="closePop1()">Update</button>

                    <!-- <input class="login-button" type="submit" name="edit" value="Add" onclick="closePop()"> -->
                </form>
            </div>
        </div>
        <?php } ?>
        <?php if(!isset($_POST['edit'])) { ?>


        <div id="mainPop2" class="pop-up2 d-none">

            <div class="container2">
                <i class="fa-solid fa-xmark" onclick="closePop2()"></i>
                <div class="heading2">Edit Priorty</div>
                <form class="form2" method="post">


                    <div class="selection2">

                        <select name="status" id="status" class="status2">
                            <option value="NULL">ٍSelect The Prority</option>
                        <?php foreach($run_sel_pri as $stats){ ?>
                            <option value="<?php echo $stats['priority_id'] ?>">
                                <?php echo $stats['priority_name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="login-button" name="edit" onclick="closePop2()">Update</button>

                    <!-- <input class="login-button" type="submit" name="edit" value="Add" onclick="closePop()"> -->
                </form>
            </div>
            <?php } ?>
        </div>
        <?php if(isset($_POST['edit'])) { ?>
        

        <?php } ?>
    </div>

    </div>






    <div class="main-add v-none" id="add_member">
        <div class="add_member">
            <form class="hjhj" method="post">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddmember()"></i>
                </div>
                <h3> Share Task</h3>
                <label for="mail">Choose Task</label>

                <select name="assignee" id="" class="status">
                <?php foreach ($run_sel as $data){ ?>
                    <?php if($user_id!=$data ['user_id']){ ?> 
                    
                <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
                <?php  }} ?>
                <?php foreach ($run_selm as $data){ ?>
                    <?php if($user_id!=$data ['user_id']){ ?>
                  <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
                  <?php  }}?>

                </select>
                <button type="submit" name="share_btn" onclick="closeaddmember()">Share</button>
            </form>
        </div>
    </div>

























    <script>
        var add_member = document.getElementById("add_member")
        function openaddmember() {
            add_member.classList.remove("v-none")
        }
        function closeaddmember() {
            add_member.classList.add("v-none")
        }
    </script>

    <!-- link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="./js/task details.js"></script>
</body>

</html>
