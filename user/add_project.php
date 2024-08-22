
<?php
include 'connection.php';
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
$user_id=$_SESSION['user_id'];  
$plan_range=$_SESSION['plan_range'];
// $error="";
if(isset($_POST['submit'])) {
    $name=$_POST['name'];

    if(!empty($name)){
    


        for ($x = 0; $x < $plan_range; $x++) {
            
            if (!empty($_POST["member"][$x])) {
                
            
                    for($z=0;$z<$plan_range;$z++) {
                        
                        if($_POST["member"][$x] == $_POST["member"][$z]){
                            if($x!=$z){
                               
                                $error="you can't add the same member twice";
                                $t=true;
                                
                            }  
                      


                        }



                    }
                }

            
            }

    }else{
        $error="please put the name of project"; 
    }
    if(empty($error)){
        $insert="INSERT  INTO projects VALUES (NULL,'$name',$user_id)";
        $run_insert=mysqli_query($connect,$insert);
        $select="SELECT * FROM projects order by project_id desc limit 1 ";
        $run_select=mysqli_query($connect,$select);
        $fetch=mysqli_fetch_assoc($run_select);
        $project_id=$_SESSION['project_id']=$fetch['project_id'];
        
        for ($x = 0; $x < $plan_range; $x++) {
            if (!empty($_POST["member"][$x])) {
            $email = $_POST["member"][$x];
                                    $select_member=" SELECT * FROM users WHERE user_email ='$email'";
                                    $run_member=mysqli_query($connect,$select_member);
                                    $fetch_member=mysqli_fetch_assoc($run_member);
                                    $number=mysqli_num_rows($run_member);
                                    
                                    if($number>0){
                                        $id=$fetch_member['user_id'];
                                        if($id!=$user_id){

                                        
                                            $insert_members="INSERT into projects_members VALUES ($project_id,$id)";
                                            $run_members=mysqli_query($connect,$insert_members);
                                            $error="added successfully";
                                            header("refresh:2 ; url=project_details.php?project_id=$project_id");
                                            // header("location:add_project.php");
        
                                        }else{
                                            $error="you cann't add the leader in project's member";
                                        }
                                        
                                    }else{
                                        $error="this email $email doesn't have account";
                                    }
    
    
                                            } } $error="added successfully";
                                            header("refresh:2 ; url=project_details.php?project_id=$project_id");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page name -->
    <title>Add Project</title>

    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- link css file -->
    <link rel="stylesheet" href="css/add project.css">

</head>

<body>

    <div class="main">
            <form class="form" method="POST">
                <div class="heading">Add New Project</div>
                <input  class="input" type="text" name="name" id="name"
                    placeholder="Project Name">
                    <?php for($x=0;$x<$plan_range;$x++) { ?>
                <input  class="input" type="email" name="member[<?php echo $x; ?>]" id="email" placeholder="Members email">
                <?php } ?>
                <?php if(isset($error)) { ?>
                <p>
              <?php echo"$error" ?>
                </p>
                <?php } ?>
                <input class="login-button" type="submit" value="Add" name="submit">
            </form>
        </div>
    </div>

    <!-- link bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- link js file -->
     <script src="js/add project.js"></script>

</body>

</html>