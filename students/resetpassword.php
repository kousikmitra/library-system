<?php
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";

session_start();
$_SESSION['err_msg'] = "";

if(!isset($_SESSION['resetemail'])
    and !isset($_SESSION['resetotp'])){
        if($_SESSION['resetotp'] == ""
            and $_SESSION['resetemail'] == ""){
                header('location:./forgotpassword.php');
            }
    } else if(isset($_POST['resetpassword'])){
        if(isset($_SESSION['resetemail'])
            and isset($_SESSION['resetotp'])){
             if($_SESSION['resetotp'] != ""
                 and $_SESSION['resetemail'] != ""){
                    $sql = "SELECT email FROM forgotpass WHERE email='{$_SESSION['resetemail']}' AND otp='{$_SESSION['resetotp']}'";
                    $result = $conn->query($sql);
                    if($result->num_rows == 1){
                        $row = $result->fetch_assoc();
                        $newpass = md5($_POST['password']);
                        $sql = "UPDATE student SET s_password = '$newpass' WHERE s_email='{$row['email']}'";
                        if($conn->query($sql)){
                            $conn->query("DELETE FROM forgotpass WHERE email='{$row['email']}'");
                            echo "<script>alert('Password Reset Successful');window.location = './index.php';</script>";
                            $_SESSION['resetemail'] = "";
                            $_SESSION['resetotp'] = "";
                        } else{
                            $_SESSION['err_msg'] = "Try Again";
                        }                        
                    } else {
                        header('location:./forgotpassword.php');
                    }
            }
        
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
          <div class="login-div" style="margin-left:35%; margin-top:2%;margin-bottom:2%;">
          <a href="./index.php" class="arrow"><i class="fa fa-arrow-left"></i> Back to Login</a>
              <form action="resetpassword.php" method="post" class="login" id="login-form">
                  <fieldset>
                      <legend>Reset Your Password</legend>
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
                      <label for="password">Password :</label>
                      <input type="password" name="password" id="password" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="confirmpassword">Confirm Password :</label>
                      <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="submit" name="resetpassword" value="Reset Password" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
          </div>
          
      </div>
   </div> 
</body>
</html>