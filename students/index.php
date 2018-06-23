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
    <link rel="stylesheet" href="..\vendor\bootstrap-4.0.0-dist\css\bootstrap.min.css">
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Central Library</title>
</head>
<body>
   <div class="main">
       <div class="status-bar"></div>
       
      <div class="top-bar">
          <div id="title">
              <h1>
                  Central Library
              </h1>
          </div>
          <div class="top-bar-right">

          </div>
      </div>
      <div class="slide-show">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="http://panskurabanamalicollege.org/img/slide-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="http://educationbengal.in/uploads/80881edubngl.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="http://panskurabanamalicollege.org/img/slide-3.jpg" alt="Third slide">
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
      </div>
      <div class="marquee">
          <marquee behavior="" direction="">This is an importatnt notification.      This is another notification.</marquee>
      </div>
      <div class="content">
          <div class="notification-left">
            <p>notification 1</p>
            <p>notification 1</p>
            <p>notification 1</p>
            <p>notification 1</p>
          </div>
          <div class="notifiaction-right">
          <p>notification 1</p>
            <p>notification 1</p>
            <p>notification 1</p>
            <p>notification 1</p>
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