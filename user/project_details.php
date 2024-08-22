
<?php
include 'connection.php';
$error="Add new member";
$plan_rang=$_SESSION['plan_range'];
$role_id=$_SESSION['role_id'];
$id=$_SESSION['user_id'];  
$search=false;
if(isset($_GET['project_id'])){
    $project_id=$_GET['project_id'];
    $_SESSION['project']=$project_id;

    $select_project="SELECT * FROM `projects` WHERE `project_id` = $project_id";
    $run_project=mysqli_query($connect,$select_project);
    $fetch=mysqli_fetch_assoc($run_project);
    $name_project=$fetch['project_name'];

$select="SELECT * FROM `projects_members` JOIN `users` ON `projects_members`.`user_id`= `users`.`user_id` WHERE `project_id`=$project_id";
$run=mysqli_query($connect,$select);
$number_member=mysqli_num_rows($run);
$select2="SELECT * FROM `projects_members` JOIN `users` ON `projects_members`.`user_id`= `users`.`user_id` WHERE `projects_members`.`project_id`=$project_id AND `projects_members`.`user_id`=$id";
$run2=mysqli_query($connect,$select2);
$number_member2=mysqli_num_rows($run2);
$select_sprint="SELECT * FROM `sprints` WHERE `project_id` =$project_id";
$run_sprint=mysqli_query($connect,$select_sprint);
// echo $name_project."<br>";
    $select_leader="SELECT * FROM `projects` WHERE `project_id`=$project_id AND user_id=$id ";
    $run_leader=mysqli_query($connect,$select_leader);
    $number_leader=mysqli_num_rows($run_leader);

    
if(isset($_POST['search_btn'])) {

$search=true;
$text= $_POST['text'];
//   $select_search="SELECT * FROM `projects`  WHERE (`project_name` like '%$text%') ";
// $select_search="SELECT * FROM `projects` 
//  JOIN `users` ON `users`.`user_id`=`projects`.`user_id`
//  join `projects_members` on `projects`.`project_id`=`projects_members`.`project_id` JOIN `users` AS `mm` ON `projects_members`.`user_id` =`mm`.``user_id``
//  WHERE(`projects`.`project_name` LIKE  '%$text%') and `users`.`user_id`=$user_id";
// $run_select_search=mysqli_query($connect,$select_search);
$select_search = "SELECT * FROM `sprints` 
    JOIN `projects` ON `projects`.`project_id` = `sprints`.`project_id`

    WHERE `sprints`.`sprint_name` LIKE '%$text%' 
    AND `sprints`.`project_id` = $project_id ";

$run_select_search = mysqli_query($connect, $select_search);
// if($run_select_search){
// foreach($run_select_search as $key){
//     echo $key['project_name'];
// };
// }
}


if(isset($_POST['submit'])){
    
    $email=$_POST['email'];
    if(!empty($email)){
        $select="SELECT * FROM `users` WHERE `user_email` ='$email'";
        $run=mysqli_query($connect,$select);
        $number=mysqli_num_rows($run);
        
        if ($number>0){
            $fetch=mysqli_fetch_assoc($run);
            $user_id=$fetch['user_id'];
            if($id!=$user_id){
            $select_member="SELECT * FROM `projects_members` where `user_id`=$user_id AND `project_id`= $project_id ";
            $run_member=mysqli_query($connect,$select_member);
            $num=mysqli_num_rows($run_member);
            if($num==0){
            
            $insert="INSERT INTO `projects_members` VALUES ($project_id, $user_id)";
            $run_insert=mysqli_query($connect,$insert);
            $error="added new member successfully";
            // header("refresh:2 ; url=project_details?project_id=$project_id");
            // header("refresh:2 ;location:project_details.php");
        }else{
            
            $error="this $email already in team <br> please add anther email ";
        }

        }else{$error="you cann't add the leader in project's member";
             }
        }else {
            $error="this $email doesn't have account<br> please add anther email";
        }
 }else{ $error ="please enter the email";}
}

}
$project_id=$_SESSION['project'];

if(isset($_GET['delete_mem'])){
    $id=$_GET['delete_mem'];
    $delete_member="DELETE FROM projects_members WHERE user_id=$id";
    $run_delete_member=mysqli_query($connect,$delete_member);
    header("location:project_details.php?project_id=$project_id");
    }




if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete_query="DELETE FROM sprints WHERE sprint_id=$id";
    $run_delete=mysqli_query($connect,$delete_query);
    header("location:project_details.php?project_id=$project_id");
    }

?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./css/sprintss.css">

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
<li class="search-box">
                    <form action="" class="ser" method="POST">

                        <button name="search_btn" type="submit" class="ser-btn">
                            <i class='bx bx-search icon'></i>
                       </button>
                        <input name="text" type="text" placeholder="Search Sprints.">

                        

                    </form>
                </li>

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


                    <div class="p-m" >
                        <li class="nav-link">
                            <a href="#" class="project-members-link">
                                <i class='bx bx-user icon'></i>
                                <span class="text nav-text">Project Members</span>
                            </a>
                            <div class="mem-list d-none" id="members">
                                <ul class="member-list" >
                                    <?php   foreach($run as $appear) {?>
                                        <div class="memb">

                                        <li class="member"><?php echo $appear['user_name'] ?></li>
                                        <?php if($number_leader>0) { ?>

                                       
                                        <a href="project_details.php?delete_mem=<?php echo $appear['user_id'] ?>"><i class="fa-solid fa-trash del" style="color:black"></i></a>
                                            <?php  } ?>
                                        </div>
                               
                                <?php } ?>

                            </ul>
                        </div>
                        </li>
                    </div>
                      <!-- --------------------project member---------------------- -->

            
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



    <!-- --------------------project member---------------------- -->
            


    <section class="home">

        <div class="main-top">


            
        <h2 class="category">
            <?php echo $name_project; ?> </h2>


<div class="bts">

<?php if($number_member2==0){
if($number_member<$plan_rang) { ?>
    <a href="#" onclick="openaddmember()" class="add-btn">

        Add Members

        <i class="fa-solid fa-user-plus" style="margin-left: 10px;"></i>
    </a>
<?php }else {?>
    <a href="#"  class="add-btn">

Members completed

<i class="fa-solid fa-user-plus" style="margin-left: 10px;"></i>
</a> <?php }  }?>
<a href="add_sprint.php?pid=<?php echo $project_id?>" class="add-btn2">
    
    Add Sprint
    
    <i class="fa-solid fa-plus" style="margin-left: 10px;"></i>
</a>

</div>







</div>
<?php if ($search) { ?>


<div class="container bootstrap snippets bootdeys">
    
    
    
    <?php foreach($run_select_search as $data){ 
        $time= $data['sprint_end'];
        $end_time=strtotime("$time");
        $time_now=strtotime("today");
       
        
        ?>

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            
            <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                <div class="content">
                    
                    <div class="hehe">
                        
                        

                        <div class="del-edit">

                        <div class="mini-del-edit">
                        <a href="project_details.php?delete=<?php echo $data[ 'sprint_id']?>">delete </a>
                        <a href="add_sprint.php?pid=<?php echo $project_id ?>&&sprint_id=<?php echo $data[ 'sprint_id']?>">edit </a>
                        </div>
                        
                        <h2 class="description"> <?php echo $data['sprint_name']; ?></h2>

                        </div>
                        
                        
                        
                        <?php if($time_now<$end_time) {
                            $days_left=$end_time-$time_now;
                            ?>
                                    <h1><i class="fa-regular fa-clock" style="margin-left: 30px;"></i> <?php echo date("d",$days_left);?></h1>
                                    <?php }else{?>
                                        <h1><i class="fa-regular fa-clock" style="margin-left: 30px;"></i> end</h1>
                                        <?php } ?>
                                        
                                        
                                    </div>

                                    <div class="view-task">




                                    <span>From :<?php echo $data['sprint_start']; ?></span>

                                    <span>To : <?php echo $data['sprint_end'];?></span>

                                    <!-- <a href="../html/task details.html">

                                        <span>
                                            <i class="fa-solid fa-circle-info" style="color: black;"></i>
                                        </span>

                                    </a> -->

                                </div>

                                <h4 class="title"><a href="sprint_details.php?project_id=<?php echo $project_id ?>&&sprint_id=<?php echo $data['sprint_id']?>">Sprint Details</a></h4>
                            </div>
                            </div>
                         
                    </div>
                </div>
            </div>
            <?php }?>

            <?php } else {?>




<div class="container bootstrap snippets bootdeys">
    
    
    
    <?php foreach($run_sprint as $data){ 
        $time= $data['sprint_end'];
        $end_time=strtotime("$time");
        $time_now=strtotime("today");
        
        ?>

<div class="row">
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            
            <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                <div class="content">
                    
                    <div class="hehe">
                        
                        
                        <div class="del-edit">

                            <div class="mini-del-edit">
<a href="project_details.php?delete=<?php echo $data[ 'sprint_id']?>"><i class="fa-solid fa-trash"></i> </a>

                        <a href="add_sprint.php?pid=<?php echo $project_id ?>&&sprint_id=<?php echo $data[ 'sprint_id']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>

                        
                        

                        <h2 class="description"> <?php echo $data['sprint_name']; ?></h2>


                        </div>
                        <?php if($time_now<$end_time) {
                            $days_left=$end_time-$time_now;
                            ?>
                                    <h1><i class="fa-regular fa-clock" style="margin-left: 30px;"></i> <?php echo date("d",$days_left);?></h1>
                                    <?php }else{?>
                                        <h1><i class="fa-regular fa-clock" style="margin-left: 30px;"></i> end</h1>
                                        <?php } ?>
                                        
                                        
                                    </div>

                                    <div class="view-task">




                                    <span>From :<?php echo $data['sprint_start']; ?></span>

                                    <span>To : <?php echo $data['sprint_end'];?></span>

                                    <!-- <a href="../html/task details.html">

                                        <span>
                                            <i class="fa-solid fa-circle-info" style="color: black;"></i>
                                        </span>

                                    </a> -->

                                </div>

                                <h4 class="title"><a href="sprint_details.php?project_id=<?php echo $project_id ?>&&sprint_id=<?php echo $data['sprint_id']?>">Sprint Details</a></h4>
                            </div>
                            </div>
                         
                    </div>
                </div>
            </div>
            <?php  } }?>





        </div>



    </section>


    <div class="main-add v-none " id="add_task">
        <div class="add_task">
            <form action="">
                <div class="icon" onclick="closeaddtask()">
                    <i class="fa-solid fa-xmark" style="color: #080808;" ></i>
                </div>

                <h3> Add New Task</h3>
                <div class="add-form">

                    <div class="inputs">
                        <label for="task">Add Task</label><br>
                        <input type="text" id="task" class="normal"><br>
                        <label for="desc">Description</label><br>
                        <input type="text" id="desc" class="normal"><br>

                    </div>
                    <div class="inputs">
                        <label for="deadline">deadline</label><br>
                        <input type="text" id="deadline" class="normal"><br>
                        <label for="email">Assignee</label><br>
                        <input type="email" id="email" class="normal"><br>

                    </div>

                </div>

                <!-- -----------------------------categoty------------------------- -->


                <div class="radio1">
                    <label for="cat" class="title">Category</label>
                    <input type="radio" name="radio" id="bug" value="bug">
                    <label for="bug">Bug</label>
                    <input type="radio" name="radio" id="task" value="task">
                    <label for="task">Task</label>
                    <input type="radio" name="radio" id="improvment" value="improvment">
                    <label for="improvment">Improvment</label><br>
                </div>


                <!-- -------------------------end category---------------------------- -->
                <!-- ---------------------------priority------------------------------- -->

                <div class="radio2">
                    <label for="priority" class="title">Priority</label>
                    <input type="radio" name="radio2" id="vhigh">
                    <label for="vhigh">Very High</label>
                    <input type="radio" name="radio2" id="high">
                    <label for="high">High</label>
                    <input type="radio" name="radio2" id="moderate">
                    <label for="moderate">Moderate</label>
                    <input type="radio" name="radio2" id="low">
                    <label for="low">Low</label>
                    <input type="radio" name="radio2" id="vlow">
                    <label for="vlow">Very Low</label><br>
                </div><br>

                <button onclick="closeaddtask()">Add</button>
            </form>
        </div>
    </div>
    <!-- ------------------------end add task popup----------------------- -->
    <?php if(!isset($_POST['submit'])) { ?>
    <div class="main-add v-none " id="add_member">
        <div class="add_member">
            <form method="POST">
                <div class="icon" onclick="closeaddmember()">
                    <i class="fa-solid fa-xmark" style="color: #080808;" ></i>
                </div> 
            
                <h3> <?php echo $error ?> </h3>
                
                <label for="mail">Email</label><br>
                <input type="email" id="mail" name="email"><br>
                <button  type="submit" name="submit" >Add Member</button>
            </form>
        </div>
    </div>
    <?php } ?>

<?php if(isset($_POST['submit'])) { ?>
        <div class="main-add " id="add_member">
        <div class="add_member">
            <form method="POST">
                <div class="icon" >
                    <i class="fa-solid fa-xmark bg-danger" style="color: #080808;" onclick="closeaddmember()"></i>
                </div> 
            
                <h3> <?php echo $error; ?> </h3>
                
                <label for="mail">Email</label><br>
                <input type="email" id="mail" name="email"><br>
                <button  type="submit" name="submit" >Add Member</button>
            </form>
        </div>
    </div>
    

    <?php } ?>
























    <script>
        const sideNav = document.querySelector('.sidebar');



        const projectMembersLink = document.querySelector('.project-members-link');
        const memberList = document.querySelector('.member-list');

        const projectMembers = ['Member1', 'Member2', 'Member3']; // Replace with your actual data

        projectMembersLink.addEventListener('click', () => {
            memberList.style.display = memberList.style.display === 'none' ? 'block' : 'none';

            // Populate the member list if it's empty
            if (memberList.children.length === 0) {
                projectMembers.forEach(member => {
                    const listItem = document.createElement('li');
                    listItem.textContent = member;
                    memberList.appendChild(listItem);
                });
            }
        });
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");
        var  member = document.getElementById("members")
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            member.classList.toggle("d-none");
          
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
        sideNav.addEventListener('transitionend', () => {
            if (sideNav.classList.contains('close')) {
                memberList.classList.add('hidden');
            } else {
                memberList.classList.remove('hidden');
            }
        });
    </script>


    <script src="./js/project.js"></script>

</body>

</html>
