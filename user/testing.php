<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parallax Scrolling Effect</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/testing.css">
</head>
<body>


    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="home-section">
    
    
              <div class="container-content">
    
                <div class="home-content">
    
                  <div class="content-txt">
    
                    <h1>Deliver more,<br> Deliver better</h1>
    
                    <p> Welcome to TodoHive, your ultimate project planning partner designed to streamline your workflow and enhance productivity.
                       At TodoHive, we understand the challenges of managing complex projects, 
                       and our platform is crafted to provide you with the tools and insights needed to stay on track. 
                       From setting goals to tracking progress and collaborating with your team. 
                    </p>
    
                    <a href="./signup.php" class="btn3">Sign Up</a>
    
                  </div>
    
    
                  <div class="content-img">
                    <img src="./images/At the office-amico.png">
                  </div>
    
                </div>
    
              </div>
            </div>
    
          </div>
          <div class="carousel-item">
    
    
            <div class="home-section">
    
    
              <div class="container-content">
    
                <div class="home-content">
    
                  <div class="content-txt">
    
                    <h1>Our Mission</h1>
    
                     <p>Our mission at TodoHive is to simplify project management for individuals and teams alike. We believe that effective planning and organization are the cornerstones of success,
                      which is why we've developed a user-friendly interface that integrates seamlessly with your existing processes.
                    </p> 
    
                    <a href="" class="btn3">Sign Up</a>
    
                  </div>
    
    
                  <div class="content-img">
                    <img src="./images/Scrum board-bro.png">
                  </div>
    
                </div>
    
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="home-section">
    
    
              <div class="container-content">
    
                <div class="home-content">
    
                  <div class="content-txt">
    
                    <h1>Start Now With ToDoHive</h1>
    
                   
    
                    <a href="./signup.php" class="btn3">Sign Up</a>
    
                  </div>
    
    
                  <div class="content-img">
                    <img src="./images/Design team-amico (1).png">
                  </div>
    
                </div>
    
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev btn1" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>


    <header>

      <h1 class="big-title translate" data-speed="0.1"></h1>


        <!-- <img src="img/personnn.png" class="person translate" data-speed="-0.25" alt="">
        <img src="img/background up.png" class="mountain1 translate" data-speed="-0.2" alt="">
        <img src="img/backobj.png" class="mountain2 translate" data-speed="0.4" alt="">
        <img src="img/backobj.png" class="mountain3 translate" data-speed="0.3" alt="">
        <img src="img/background up.png" class="sky translate" data-speed="0.5" alt=""> -->
    </header>

    <section>
        <div class="shadow">

            
        </div>

        <div class="container">
            <div class="content opacity">
                <h3 class="title">
                    How to start
                    <div class="border"></div>
                </h3>
                <p class="text">The fastest way to get tasks out of your head.
                  Type just about anything into the task field and Todoist’s one-of-its-kind natural language recognition will instantly fill your to-do list.
                  </p>
                <a href="./login.php" class="btn4">Login</a>
              
            </div>

            <div class="imgContainer opacity">
                <!-- <img src="img/image.jpg" alt=""> -->
                <video controls autoplay muted src="./images/04- animation.mp4" width="300px"></video>
            </div>
        </div>
    </section>
    


    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>


    <script src="./js/testing.js"></script>
</body>
</html>