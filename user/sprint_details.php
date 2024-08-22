
<?php
include 'mail_task.php';

$id = $_GET['project_id']; // Assuming project_id is passed via GET, default to 6 if not set
$sprint_id = $_GET['sprint_id'];
$user_id=$_SESSION['user_id'];
$_SESSION['project_id']=$id;
$_SESSION['sprint_id']=$sprint_id;
if (!$sprint_id) {
    die('Sprint ID is not set.');
}



$status_sel="SELECT *  FROM `priority`";
$run_status=mysqli_query($connect,$status_sel);
// Debugging: Print the sprint ID
echo "Sprint ID: " . htmlspecialchars($sprint_id) . "<br>";

// Fetch sprint details
$select_sprint = "SELECT * FROM sprints WHERE `sprint_id` = $sprint_id";
$run_sprint = mysqli_query($connect, $select_sprint);

$selmem="SELECT * FROM `projects_members` JOIN `users` ON `users`.`user_id` = `projects_members`. `user_id` WHERE `project_id`= $id ";
$run_selm=mysqli_query($connect,$selmem);

$sel="SELECT * FROM `projects`

 JOIN `users` as `leader` ON `leader`.`user_id` = `projects`.`user_id`

WHERE `projects`.project_id= $id ";
$run_sel=mysqli_query($connect,$sel);

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
    if(!empty($task_name) &&  !empty($description) && !empty($deadline) &&!empty($members) &&!empty($category) &&!empty($pri)){
        $time=strtotime("today");
        $deadline_unx=strtotime("$deadline");
        if($deadline_unx>=$time){

      $insert="INSERT INTO tasks VALUES (NULL, '$task_name','$description','$deadline','$user_id','$members','1','$category','$pri',$sprint_id)";
            $run_insert=mysqli_query($connect,$insert);
                        $select_task="SELECT * FROM tasks ORDER BY task_id desc limit 1";
            $run_select_task=mysqli_query($connect ,$select_task);
            $fetch_task=mysqli_fetch_assoc($run_select_task);
            $taskid=$fetch_task['task_id'];
            $error="task added successfully";
            include("mail task.php");
    header("refresh:2; url=sprint_details.php?project_id=$id&&sprint_id=$sprint_id");
        }else{
            $error="cann't old date in deadline";
        }
    }else {
        $error="please,enter all data";
    }

}
if ($fetch = mysqli_fetch_assoc($run_sprint)) {
    $sprint_name = $fetch['sprint_name'];
    $sprint_start = $fetch['sprint_start'];
    $sprint_end = $fetch['sprint_end'];
    $now = strtotime("today");
    $end = strtotime($sprint_end);
    if ($end >= $now) {
        $days_left = ($end - $now) / (60 * 60 * 24);
    }
}

if (isset($_POST['filter'])) {
    $filter = true;
    $priority = $_POST['filter'];

    $select_filter1 = "SELECT * FROM `tasks` JOIN `priority` ON `tasks`.`priority_id` = `priority`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 1 AND `tasks`.`priority_id` = $priority ORDER BY `tasks`.`priority_id` ASC";
    echo "Query: " . $select_filter1 . "<br>";
    $run_select1 = mysqli_query($connect, $select_filter1);

    $select_filter2 = "SELECT * FROM `tasks` JOIN `priority` ON `tasks`.`priority_id` = `priority`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 2 AND `tasks`.`priority_id` = $priority ORDER BY `tasks`.`priority_id` ASC";
    echo "Query: " . $select_filter2 . "<br>";
    $run_select2 = mysqli_query($connect, $select_filter2);

    $select_filter3 = "SELECT * FROM `tasks` JOIN `priority` ON `tasks`.`priority_id` = `priority`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 3 AND `tasks`.`priority_id` = $priority ORDER BY `tasks`.`priority_id` ASC";
    echo "Query: " . $select_filter3 . "<br>";
    $run_select3 = mysqli_query($connect, $select_filter3);

    $select_filter4 = "SELECT * FROM `tasks` JOIN `priority` ON `tasks`.`priority_id` = `priority`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 4 AND `tasks`.`priority_id` = $priority ORDER BY `tasks`.`priority_id` ASC";
    echo "Query: " . $select_filter4 . "<br>";
    $run_select4 = mysqli_query($connect, $select_filter4);
}

$status1 = "SELECT * FROM `tasks` JOIN `priority` ON `priority`.`priority_id` = `tasks`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 1 ORDER BY `tasks`.`priority_id` ASC";
echo "Query: " . $status1 . "<br>";
$run1 = mysqli_query($connect, $status1);

$status2 = "SELECT * FROM `tasks` JOIN `priority` ON `priority`.`priority_id` = `tasks`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 2 ORDER BY `tasks`.`priority_id` ASC";
echo "Query: " . $status2 . "<br>";
$run2 = mysqli_query($connect, $status2);

$status3 = "SELECT * FROM `tasks` JOIN `priority` ON `priority`.`priority_id` = `tasks`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 3 ORDER BY `tasks`.`priority_id` ASC";
echo "Query: " . $status3 . "<br>";
$run3 = mysqli_query($connect, $status3);

$status4 = "SELECT * FROM `tasks` JOIN `priority` ON `priority`.`priority_id` = `tasks`.`priority_id` WHERE `sprint_id` = $sprint_id AND `status_id` = 4 ORDER BY `tasks`.`priority_id` ASC";
echo "Query: " . $status4 . "<br>";
$run4 = mysqli_query($connect, $status4);
if(isset($_POST['delete'])){
    $Did=$_POST['delete_id'];
    $delete_query="DELETE FROM tasks WHERE task_id=$Did";
    $run_delete=mysqli_query($connect,$delete_query);
    header("location:sprint_details.php?project_id=$id&&sprint_id=$sprint_id");
    }
?>



<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!--<title>Dashboard Sidebar Menu</title>-->


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./css/sprintdetails.css">

</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="./images/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">ToDoHive</span>
                    <span class="profession">Plannnig Tool</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
<!-- search bar------------------------------------- -->
<!-- <li class="search-box">
                    <form action="" class="ser">

                        <button type="submit" class="ser-btn" name="">
                            <i class='bx bx-search icon'></i>
                       </button>
                        <input type="text" placeholder="Search projects...">

                        

                    </form>
                </li> -->

                <ul class="menu-links">


                    <li class="nav-link">
                        <a href="./dashboard2.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Projects</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./profile.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
<!-- end search bar -->

            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <form action="" method="POST">
                        <button id="log-t" name="logout" type="submit" class="text nav-text logout">Logout</button>
                        </form>                     
                    </a>
                </li>



            </div>
        </div>

    </nav>





    <section class="home">

        <div class="main-top">



            <h2 class="category">
            <?php echo $sprint_name; ?> </h2>
        </div>
<?php if($end >=$now){?>
        <a href="#" class="add-btn" onclick="openaddtask()">

            Add Task

            <i class="fa-solid fa-circle-plus" style="font-size: 15px; color: black; margin-left: 10px;"></i>
        </a>

<?php } ?>

        <!-- ------------------Filter------------------------------------------ -->

        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Priority<i class="fa-solid fa-sort-down"
                    style="margin-left: 10px;"></i>
             </button>
             <div id="myDropdown" class="dropdown-content">
<form action="" method="POST">

    <?php foreach($run_status as $data ){?>
    <button type="submit" value="<?php echo $data['priority_id'] ;?>" name="filter" class="filt"><?php echo $data['priority_name'] ;    ?></button>
    <?php } ?>
</form>
        </div>
        </div>


        <!-- -----------------------end filter----------------- -->

        <div class="container bootstrap snippets bootdeys">

            <!-- awel al to do ===================================================================== -->


<div class="koko-card">

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">


                    <div class="hehe">


                        <h2 class="category">
                            TO DO</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- start heree======================================================================================= -->
                <?php if (mysqli_num_rows($run1) > 0) {
                    if (isset($_POST['filter'])) {
                        if (mysqli_num_rows($run_select1) > 0) {
                            foreach ($run_select1 as $data) { ?>

                            

                                <div class="view-task">
                                        <p class="description">  <?php echo $data['task_name']; ?> </p>

                                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                                        <span class="del-viw">
                                <i class="fa-solid fa-circle-info" style="color: black;"></i>

<!-- condition delete -->
                                <?php if ($user_id===$data['reporter']){ ?>
                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['task_id'] ?>">
                                            <button type="submit" name="delete" class="delete">
                                                <i class="fa-solid fa-trash">

                                                </i>
                                            </button>
                                        </form>
<?php } ?>
<!--end condition l delete  -->
                                
                            </span>
                                        </a>


                                    </div>
                                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                                    <?php }
                        } else { ?>
                         
                                <p class="no-error">No tasks uploaded yet. Start by adding a new task!<p>
                           
                        <?php }
                    } else {
        foreach ($run1 as $data) { ?>



<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">

                    <div class="view-task">
                        <p class="description">  <?php echo $data['task_name']; ?> </p>





                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                        

                            <span class="del-viw">
                                <i class="fa-solid fa-circle-info" style="color: black;"></i>

<!-- condition delete -->
                                <?php if ($user_id===$data['reporter']){ ?>
                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['task_id'] ?>">
                                            <button type="submit" name="delete" class="delete">
                                                <i class="fa-solid fa-trash">

                                                </i>
                                            </button>
                                        </form>
<?php } ?>
<!--end condition l delete  -->
                                
                            </span>
                        </a>
                    </div>
                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                </div>
            </div>
        </div>
    </div>
</div>
                    <?php } }
                
                } else { ?>
                        

                <p class="no-error"> No tasks uploaded yet. Start by adding a new task!</P>
                <?php } ?>


<!-- end here================================================================================= -->

</div>


          <!-- awel al to do ===================================================================== -->


          <div class="koko-card">

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">


                    <div class="hehe">


                        <h2 class="category">
                            In Progress</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- start heree======================================================================================= -->
                <?php if (mysqli_num_rows($run2) > 0) {
                    if (isset($_POST['filter'])) {
                        if (mysqli_num_rows($run_select2) > 0) {
                            foreach ($run_select2 as $data) { ?>

                                <div class="view-task">
                                        <p class="description">  <?php echo $data['task_name']; ?> </p>

                                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                                   

                                            <span>
                                                <i class="fa-solid fa-circle-info" style="color: black;"></i>
                                            </span>
                                        </a>


                                    </div>
                                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                                    <?php }
                        } else { ?>
                         
                                <p class="no-error">No tasks uploaded yet. Start by adding a new task!<p>
                           
                        <?php }
                    } else {
        foreach ($run2 as $data) { ?>



<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">

                    <div class="view-task">
                        <p class="description">  <?php echo $data['task_name']; ?> </p>





                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                        

                            <span class="del-viw">
                                <i class="fa-solid fa-circle-info" style="color: black;"></i>

<!-- condition delete -->
                                <?php if ($user_id===$data['reporter']){ ?>
                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['task_id'] ?>">
                                            <button type="submit" name="delete" class="delete">
                                                <i class="fa-solid fa-trash">

                                                </i>
                                            </button>
                                        </form>
<?php } ?>
<!--end condition l delete  -->
                                
                            </span>
                        </a>
                    </div>
                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                </div>
            </div>
        </div>
    </div>
</div>
                    <?php } }
                
                } else { ?>
                        

                <p class="no-error"> No tasks uploaded yet. Start by adding a new task!</P>
                <?php } ?>


<!-- end here================================================================================= -->

</div>

          <!-- awel al to do ===================================================================== -->


          <div class="koko-card">

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">


                    <div class="hehe">


                        <h2 class="category">
                            Testing</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- start heree======================================================================================= -->
                <?php if (mysqli_num_rows($run3) > 0) {
                    if (isset($_POST['filter'])) {
                        if (mysqli_num_rows($run_select2) > 0) {
                            foreach ($run_select3 as $data) { ?>

                                <div class="view-task">
                                        <p class="description">  <?php echo $data['task_name']; ?> </p>

                                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                                     

                                            <span>
                                                <i class="fa-solid fa-circle-info" style="color: black;"></i>
                                            </span>
                                        </a>


                                    </div>
                                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                                    <?php }
                        } else { ?>
                         
                                <p class="no-error">No tasks uploaded yet. Start by adding a new task!<p>
                           
                        <?php }
                    } else {
        foreach ($run3 as $data) { ?>



<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">

                    <div class="view-task">
                        <p class="description">  <?php echo $data['task_name']; ?> </p>





                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                       

                            <span class="del-viw">
                                <i class="fa-solid fa-circle-info" style="color: black;"></i>

<!-- condition delete -->
                                <?php if ($user_id===$data['reporter']){ ?>
                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['task_id'] ?>">
                                            <button type="submit" name="delete" class="delete">
                                                <i class="fa-solid fa-trash">

                                                </i>
                                            </button>
                                        </form>
<?php } ?>
<!--end condition l delete  -->
                                
                            </span>
                        </a>
                    </div>
                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                </div>
            </div>
        </div>
    </div>
</div>
                    <?php } }
                
                } else { ?>
                        

                <p class="no-error"> No tasks uploaded yet. Start by adding a new task!</P>
                <?php } ?>


<!-- end here================================================================================= -->

</div>

          <!-- awel al to do ===================================================================== -->


<div class="koko-card">

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">


                    <div class="hehe">


                        <h2 class="category">
                            Done</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- start heree======================================================================================= -->
                <?php if (mysqli_num_rows($run4) > 0) {
                    if (isset($_POST['filter'])) {
                        if (mysqli_num_rows($run_select2) > 0) {
                            foreach ($run_select4 as $data) { ?>

                                <div class="view-task">
                                        <p class="description">  <?php echo $data['task_name']; ?> </p>

                                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                                        

                                            <span>
                                                <i class="fa-solid fa-circle-info" style="color: black;"></i>
                                            </span>
                                        </a>


                                    </div>
                                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                                    <?php }
                        } else { ?>
                         
                                <p class="no-error">No tasks uploaded yet. Start by adding a new task!<p>
                           
                        <?php }
                    } else {
        foreach ($run4 as $data) { ?>



<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card card-just-text" data-background="color" data-color="blue"
                data-radius="none">
                <div class="content">

                    <div class="view-task">
                        <p class="description">  <?php echo $data['task_name']; ?> </p>





                        <a href="taskdetails.php?project_id=<?php echo $id ?>&&sprint_id=<?php echo $sprint_id ?>&&details=<?php echo $data ['task_id']?>">
                      

                            <span class="del-viw">
                                <i class="fa-solid fa-circle-info" style="color: black;"></i>

<!-- condition delete -->
                                <?php if ($user_id===$data['reporter']){ ?>
                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $data['task_id'] ?>">
                                            <button type="submit" name="delete" class="delete">
                                                <i class="fa-solid fa-trash">

                                                </i>
                                            </button>
                                        </form>
<?php } ?>
<!--end condition l delete  -->
                                
                            </span>
                        </a>
                    </div>
                    <p class="description"> Priority:  <?php echo $data['priority_name'];?></p>

                </div>
            </div>
        </div>
    </div>
</div>
                    <?php } }
                
                } else { ?>
                        

                <p class="no-error"> No tasks uploaded yet. Start by adding a new task!</P>
                <?php } ?>


<!-- end here================================================================================= -->

</div>


<!-- a5er al TO DO ================================================================================= -->




    </section>


    <!-- ------------------------add task popup---------------------- -->
   <!-- ------------------------add task popup---------------------- -->
    <?php if(!isset($_POST['submit'])){ ?>
   <div class="main-add v-none " id="add_task">
        <div class="add_task">
            <form method="POST">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddtask()"></i>
                </div>

                <h3> Add New Task</h3>
                <div class="add-form">

                    <div class="inputs">
                        
                        <label for="task">Task Name</label><br>
                        <input type="text" id="task" class="normal" name="name"><br>
                        <label for="desc">Description</label><br>
                        <input type="text" id="desc" class="normal" name="description"><br>

                    </div>
                    <div class="inputs">
                        <label for="deadline">deadline</label><br>
                        <input type="date" id="deadline" class="normal" name="deadline"><br>
                        <label for="Assignee">Assignee</label><br>
                        <select name="members" id="Assignee">
                        <?php foreach ($run_sel as $data){ ?>
                      

            <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
      <?php  } ?>
      <?php foreach ($run_selm as $data){ ?>
        <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
        <?php  } ?>
                        </select>

                    </div>

                </div>

                <!-- -----------------------------categoty------------------------- -->


                <div class="radio1">

                    <label for="cat" class="title">Category</label>
                    <?php foreach ($run_c as $data){ ?>
                    <input type="radio" name="category" id="<?php echo $data ['category_name'] ?>" value="<?php echo $data ['category_id'] ?>">
                    <label for="<?php echo $data ['category_name'] ?>"><?php echo $data ['category_name'] ?></label>
                 <?php } ?>
                </div>


                <!-- -------------------------end category---------------------------- -->
                <!-- ---------------------------priority------------------------------- -->
                <div class="radio2">
                <?php foreach ($run_p as $data){ ?>
                    <label for="<?php echo $data ['priority_name']?>" class="title"><?php echo $data ['priority_name']?></label>
                    <input type="radio" name="priority" id="<?php echo $data ['priority_name']?>" value="<?php echo $data ['priority_id']?>">
                    <?php } ?>
                    <!-- <label for="vhigh">Very High</label>
                    <input type="radio" name="radio2" id="high">
                    <label for="high">High</label>
                    <input type="radio" name="radio2" id="moderate">
                    <label for="moderate">Moderate</label>
                    <input type="radio" name="radio2" id="low">
                    <label for="low">Low</label>
                    <input type="radio" name="radio2" id="vlow">
                    <label for="vlow">Very Low</label><br> -->
                </div><br>

                <button type="submit" name="submit">Add</button>
            </form>
        </div>
    </div>
    <!-- ------------------------end add task popup----------------------- -->
    <!-- ------------------------end add task popup----------------------- -->
    <div class="main-add v-none " id="add_member">
        <div class="add_member">
            <form action="">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddmember()"></i>
                </div>
                <h3> Add New Member</h3>
                <label for="mail">Email</label><br>
                <input type="email" id="mail"><br>
                <button type="submit" >Add Member</button>
            </form>
        </div>
    </div>
<?php }else{ ?>

    <div class="main-add  " id="add_task">
        <div class="add_task">
            <form method="POST">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddtask()"></i>
                </div>

                <h3> <?php echo $error ?></h3>
                <div class="add-form">

                    <div class="inputs">
                        
                        <label for="task">Task Name</label><br>
                        <input type="text" id="task" class="normal" name="name"><br>
                        <label for="desc">Description</label><br>
                        <input type="text" id="desc" class="normal" name="description"><br>

                    </div>
                    <div class="inputs">
                        <label for="deadline">deadline</label><br>
                        <input type="date" id="deadline" class="normal" name="deadline"><br>
                        <label for="Assignee">Assignee</label><br>
                        <select name="members" id="Assignee">
                        <?php foreach ($run_sel as $data){ ?>
            <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
        
      <?php  } ?>
      <?php foreach ($run_selm as $data){ ?>
        <option value="<?php echo $data ['user_id'] ?>"><?php echo $data ['user_name']?></option>
        <?php  } ?>
                        </select>

                    </div>

                </div>

                <!-- -----------------------------categoty------------------------- -->


                <div class="radio1">

                    <label for="cat" class="title">Category</label>
                    <?php foreach ($run_c as $data){ ?>
                    <input type="radio" name="category" id="<?php echo $data ['category_name'] ?>" value="<?php echo $data ['category_id'] ?>">
                    <label for="<?php echo $data ['category_name'] ?>"><?php echo $data ['category_name'] ?></label>
                 <?php } ?>
                </div>


                <!-- -------------------------end category---------------------------- -->
                <!-- ---------------------------priority------------------------------- -->

                <div class="radio2">
                <?php foreach ($run_p as $data){ ?>
                    <label for="<?php echo $data ['priority_name']?>" class="title"><?php echo $data ['priority_name']?></label>
                    <input type="radio" name="priority" id="<?php echo $data ['priority_name']?>" value="<?php echo $data ['priority_id']?>">
                    <?php } ?>
                    <!-- <label for="vhigh">Very High</label>
                    <input type="radio" name="radio2" id="high">
                    <label for="high">High</label>
                    <input type="radio" name="radio2" id="moderate">
                    <label for="moderate">Moderate</label>
                    <input type="radio" name="radio2" id="low">
                    <label for="low">Low</label>
                    <input type="radio" name="radio2" id="vlow">
                    <label for="vlow">Very Low</label><br> -->
                </div><br>

                <button type="submit" name="submit">Add</button>
            </form>
        </div>
    </div>
<?php } ?>









    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })
        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        }) 
        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });
    </script>

    <script src="./js/project.js"></script>
</body>

</html>
