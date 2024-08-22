
<?php
include 'connection.php';
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];


$search=FALSE;
if(isset($_POST['search_btn'])) {
$search=true;
$text= $_POST['text'];

$select_search="SELECT * FROM `projects` 
WHERE `projects`.`project_name` LIKE '%$text%'
AND `user_id` = $user_id";

$selllll="SELECT * FROM `projects_members`
 RIGHT JOIN `projects` ON `projects`.`project_id` = `projects_members`.`project_id`
  WHERE (`projects_members`.`user_id`=$user_id OR `projects`.`user_id`=$user_id) AND `projects`.`project_name` LIKE '%$text%'
UNION
SELECT * FROM `projects_members`
LEFT JOIN `projects` ON `projects`.`project_id` = `projects_members`.`project_id`

 WHERE (`projects_members`.`user_id`=$user_id OR `projects`.`user_id`=$user_id) AND `projects`.`project_name` LIKE '%$text%' ";

$run_select_search = mysqli_query($connect, $selllll);

}


$select = "SELECT * FROM `projects`  JOIN `users` ON `users`.`user_id`=`projects`.`user_id`
-- left join `projects_members` on `projects`.`project_id`=`projects_members`.`project_id`
 WHERE `users`.`user_id`=$user_id ";
$run = mysqli_query($connect, $select);

$select2 = "SELECT * FROM `projects`
left join `projects_members` on `projects`.`project_id`=`projects_members`.`project_id`
 WHERE `projects_members`.`user_id`=$user_id ";
$run2 = mysqli_query($connect, $select2);

$hasProjects = mysqli_num_rows($run);
// $fetch=mysqli_fetch_assoc($run);
// $role_id=$fetch['role_id'];
if(isset($_GET['delete'])){
$id=$_GET['delete'];
$delete_query="DELETE FROM projects WHERE project_id=$id";
$run_delete=mysqli_query($connect,$delete_query);
header("location:dashboard2.php");
}



#if condation
// $addProjectURL = ($user_id == 1) ? 'project_page.php' : 'subscription.php';
?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./css/dashboard1.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!--<title>Dashboard Sidebar Menu</title>-->






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

            <li class="search-box">
                    <form action="" method="POST" class="ser">

                        <button type="submit" class="ser-btn" name="search_btn">
                            <i class='bx bx-search icon'></i>
                       </button>
                        <input type="text" name="text" placeholder="Search projects...">

                        

                    </form>
                </li>

                <ul class="menu-links">


                    <li class="nav-link">
                        <a href="./dashboard2.php   ">
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


            </div>

            <div class="bottom-content" for="log-t">
                <li class="">
                    <a href="#" class="logout-a">
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

<!-- hena aho a3meli al if  3ala al add w2 al subscribeee -->
    <div class="add-btns">
        <?php if($role_id ==2) {  ?>
             <a href="subscription.php" class="add-btn">Upgrade <span><i class='bx bx-plus icon' style="font-size: 20px;"></i></span></a>
        <a href="add_project.php" class="add-btn">Add Project <span><i class='bx bx-plus icon' style="font-size: 20px;"></i></span></a>
        <!-- <a href="" class="add-btn">Add Project <span>
            <i class='bx bx-plus icon' style="font-size: 20px;"></i> -->
            <?php } else{ ?>
        <!-- </span> </a> -->
        <a href="subscription.php" class="add-btn1">Subscribe <span><i class='bx bx-plus icon' style="font-size: 20px;"></i></span></a>
        <?php  } ?>
        </div>

<!-- 

        <a href="subscription.php" class="add-btn">subscribe<span>
            <i class='bx bx-plus icon' style="font-size: 20px;"></i>
        </span> </a>
 -->

<!-- -------------------------------------------------------------------------- -->

        <div class="container bootstrap snippets bootdeys">

            <!-- card loop here!!!!----------------------------------------------------------------------------- -->
            <?php if($search){?>

<?php foreach($run_select_search as $data){?>

    <div class="row">
        <div class="col-md-4 col-sm-6 content-card">
            <div class="card-big-shadow">
                <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                    <div class="content">

                        <div class="hehe">



                            <h2 class="category"><?php echo $data['project_name'] ?></h2>

                            <a class="del" href="dashboard2.php?delete=<?php echo $data[ 'project_id']?>">
                            <?php 
                                    $project_id=$data['project_id'];
$select_leader="SELECT * FROM `projects` WHERE user_id=$user_id AND project_id=$project_id ";
$run_leader=mysqli_query($connect,$select_leader);
$number_leader=mysqli_num_rows($run_leader);


                                    if($number_leader>0){ ?> 
                                    <a class="del" href="dashboard2.php?delete=<?php echo $data[ 'project_id']?>"><i class="fa-solid fa-trash" style="color:black; font-size:12px"></i></a>
                                    <?php } ?>

                        </div>



                        <div class="view-task">

                            <a href="">

                                <span>
                                </span>

                            </a>

                        </div>


                    
                        <p class="title"><a href="project_details.php?project_id=<?php echo $data['project_id']?>">View Project</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }  ?>
<?php   } else {?>

<?php foreach($run as $data){?>
            <div class="row">
                <div class="col-md-4 col-sm-6 content-card">
                    <div class="card-big-shadow">
                        <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                            <div class="content">

                                <div class="hehe">



                                    <h2 class="category"><?php echo $data ['project_name'] ?></h2>
                                        
                                    <?php 
                                    $project_id=$data['project_id'];
$select_leader="SELECT * FROM `projects` WHERE user_id=$user_id AND project_id=$project_id ";
$run_leader=mysqli_query($connect,$select_leader);
$number_leader=mysqli_num_rows($run_leader);


                                    if($number_leader>0){ ?> 
                                    <a class="del" href="dashboard2.php?delete=<?php echo $data[ 'project_id']?>"><i class="fa-solid fa-trash" style="color:black; font-size:12px"></i></a>
                                    <?php } ?>
                                </div>



                                <div class="view-task">

                                    <a href="">

                                        <span>
                                        </span>

                                    </a>

                                </div>



                                <p class="title"><a href="project_details.php?project_id=<?php echo $data['project_id']?>">View Project</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }foreach($run2 as $data){?>
            <div class="row">
                <div class="col-md-4 col-sm-6 content-card">
                    <div class="card-big-shadow">
                        <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                            <div class="content">

                                <div class="hehe">



                                    <h2 class="category"><?php echo $data ['project_name'] ?></h2>

                           

                             <?php 
                                    $project_id=$data['project_id'];
$select_leader="SELECT * FROM `projects` WHERE user_id=$user_id AND project_id=$project_id ";
$run_leader=mysqli_query($connect,$select_leader);
$number_leader=mysqli_num_rows($run_leader);


                                    if($number_leader>0){ ?> 
                                    <a class="del" href="dashboard2.php?delete=<?php echo $data[ 'project_id']?>"><i class="fa-solid fa-trash" style="color:black; font-size:12px"></i></a>
                                    <?php } ?>

                                </div>



                                <div class="view-task">

                                    <a href="">

                                        <span>
                                        </span>

                                    </a>

                                </div>



                                <p class="title"><a href="project_details.php?project_id=<?php echo $data['project_id']?>">View Project</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php }} ?>
            <!-- end card loop!!!!================================================================ -->

            



        </div>



    </section>


    <!-- ------------------------add task popup---------------------- -->
    <div class="main-add v-none " id="add_task">
        <div class="add_task">
            <form action="">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddtask()"></i>
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
    <div class="main-add v-none " id="add_member">
        <div class="add_member">
            <form action="">
                <div class="icon">
                    <i class="fa-solid fa-xmark fa-xl" style="color: #080808;" onclick="closeaddmember()"></i>
                </div>
                <h3> Add New Member</h3>
                <label for="mail">Email</label><br>
                <input type="email" id="mail"><br>
                <button type="submit" onclick="closeaddmember()">Add Member</button>
            </form>
        </div>
    </div>


















    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            // searchBtn = body.querySelector(".search-box"),
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
