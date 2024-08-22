<?php
include "connection.php";
// $uid=2;
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
$uid=$_SESSION['user_id'];
$user="SELECT * FROM `users` WHERE `user_id` = $uid ";
$RunUser=mysqli_query($connect,$user); 
$fetch=mysqli_fetch_assoc($RunUser);
$usrename=$fetch['user_name'];
$email=$fetch['user_email'];

$select="SELECT * FROM `users`
JOIN `tasks` ON `users`.`user_id`= `tasks`.`assignee` where `tasks`.`assignee`=$uid";
$RunSelect=mysqli_query($connect,$select); 
$select_error="SELECT * FROM `tasks` where `assignee`=$uid";
$run_error=mysqli_query($connect,$select_error);
$rows=mysqli_num_rows($run_error);
// $fetch=mysqli_fetch_assoc($RunSelect);
// $taskname=$fetch['task_name'];
// $desc=$fetch['task_description'];

// $usrename=$fetch['user_name'];
// $usrename=$fetch['user_name'];
// $usrename=$fetch['user_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- link css file -->
    <link rel="stylesheet" href="./css/profile page.css">

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

    <div class="home">

  
    

    <!-- Main heading section -->
    <div class="main-heading">
        <h1>User Information</h1>
    </div>

    <div class="main-2">
        <!-- User information container -->
        <div class="container-2">
            <form class="form-2" method="post">
                <!-- Username label and value -->
                <label>
                    Username:
                </label>

                <p><?php echo $usrename?></p>

                <!-- Email label and value -->
                 <br>
                <label>
                    E-mail:
                </label>

                <p><?php echo $email?></p>



                <div class="btn">

                    <a href="./change_pass.php" class="btn">
                        Change Password
                    </a>
                

                
                    <button type="submit" name="logout">
                        Logout<i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>

                
            </form>
        </div>

        <div class="container1">
            
            <!-- Looping section for tasks (repeat this block for multiple tasks) -->
            <?php foreach ($RunSelect as $data){ ?> 
              <div class="card">  
          
                <h1>

                <!-- <?php //echo $data ['project_name'] ?> -->

                </h1>
                <h3>
                    Task Name:
                </h3>

                <p><?php echo $data['task_name'] ?>

                </p>
                <h3>
                    Task Description:
                </h3>
                <p>

                <?php echo $data ['task_description'] ?>

                </p>
            </div>
            <!-- End of looping section -->
            <?php } ?>
        </div>
    </div>




    <div class="card">  
          <?php if($rows==0) { ?>

         
                <h2>

            No Task Uploded

                </h2>
           <?php } ?>
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


    <!-- Link bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Link custom JavaScript file -->
    <script src="../js/profile page.js"></script>


</body>

</html>
