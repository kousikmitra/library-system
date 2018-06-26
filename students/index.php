<?php
    session_start();
    $_SESSION['err_msg'] = "";
    if(isset($_POST['login'])) {
        include_once "./includes/dbconnection.php";
        
        $semail = $_POST['email'];
        $spassword = md5($_POST['password']);
    
        if($semail != ""
            and $spassword != ""
            ) {
    
                $sql = "SELECT * FROM student WHERE s_email='$semail' AND s_password='$spassword' AND s_status='1'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $_SESSION['id'] = $row['s_id'];
                    $_SESSION['email'] = $row['s_email'];
                    $_SESSION['name'] = $row['s_name'];
                    $_SESSION['err_msg'] = $row['s_name'];
                    header('location:./home.php');
                } else {
                    echo "<script>alert('Login Failed !');</script>";
                    $_SESSION['err_msg'] = $conn->error;
                }
    
            } else {
                echo "<script>alert('Please Enter Email or Password!');</script>";
                $_SESSION['err_msg'] = "Please Enter Email or Password!";
    
            }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <link rel="stylesheet" href=".\css\index.css">
    <?php include_once "./includes/bootstrap.php"; ?>
    <title>Central Library</title>
</head>
<body>
   <div class="main">
       <div class="status-bar"></div>
       
      <div class="top-bar">
          <div id="title">       
              <h3>
              <u>Panskura Banamali College</u> 
              <break>
              <h5>
              Central Library
              </h5>
              <br> 
              </h1>

              <img src="http://librarypbc.org/wp-content/uploads/2016/01/logo.png" alt="Panskura Banamali College" height=150>
          </div>
          <div class="top-bar-right">

          </div>
      </div>
      <div class="slide-show">
      <img src=".\images\topbar.jpg" alt="Image">
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="http://panskurabanamalicollege.org/img/slide-1.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h2><i class="fa fa-quote-left"></i> A library is like an island in the middle of vast sea of ignorance, particularly if the library is very tall and surrounding area has been flooded. <i class="fa fa-quote-right"></i></h2>
        <strong style="float:right;">~ Lemony Snicket</strong>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="http://educationbengal.in/uploads/80881edubngl.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h2><i class="fa fa-quote-left"></i> Libraries are more important to the education system than the institutions such as schools, colleges and universities.  <i class="fa fa-quote-right"></i></h2>
        <strong style="float:right;">~ Rabindranath Tagore</strong>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="http://panskurabanamalicollege.org/img/slide-3.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h2><i class="fa fa-quote-left"></i> The only thing that you absolutely have to know is the location of the library. <i class="fa fa-quote-right"></i></h2>
        <strong style="float:right;">~ Albert Einstein</strong>
    </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
>>>>>>> 4836867277ccdf4eab5e901a2d95f130c14cbdef
      </div>
      <div class="marquee">
          <marquee behavior="" direction="">This is an importatnt notification.      This is another notification.</marquee>
      </div>
      <div class="content">
          <div class="notification-left">
            <b><u> Principal Desk:</u></b>
               <img src="./images/principal.jpg" alt="profile" height="100" width="100">
    
             <i>Welcome To Our College Central Library which helps all of you to find all kind of latest books.</i>
</p>
            </div>
          <div class="notification-right">
         </div>
         
          <div class="login-div">
              <form action="index.php" method="post" class="login" id="login-form">
                  <fieldset>
                      <legend>Login</legend>
                      <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                      <div class="alert alert-danger">
                          <strong><?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?></strong>    
                      </div>
                      <?php
                      }
                      ?>
                  <div class="form-group">
                      <label for="email">Email :</label>
                      <input type="email" name="email" id="email" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="password">Password :</label>
                      <input type="password" name="password" id="password" class="form-control">
                  </div>
                  <div class="form-group">
                  <input type="submit" name="login" value="login" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
              <div class="options">
                  <p><a href="./forgotpassword.php">forgot password?</a></p>
                  <p>New here?<a href="./registration.php"> Register</a></p>
              </div>
          </div>
          
      </div>
   </div> 
   <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</body>
</html>