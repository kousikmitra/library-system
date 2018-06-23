<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";

    session_start();
    $_SESSION['err_msg'] = "";
    $flag = false;
    /*
    This is the code for checking whether a email is in the database and if the email exists in database then
    send a reset email to that email and save the info to database.
    */
    if(isset($_POST['reset'])) {
        
        $semail = $_POST['email'];
        
        if($semail != "") {
    
                $sql = "SELECT s_email FROM student WHERE s_email='$semail'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();

                    $otp = randomNumber(5);

                    $linktext = md5($semail.$otp);
                    $link = 'http://127.0.0.1/library-system/students/forgotpassword.php?resetbylink=true&link='.$linktext;

                    $sql = "INSERT INTO forgotpass (email, link, otp) VALUES ('$semail', '$linktext', '$otp') ON DUPLICATE KEY UPDATE link='$linktext', otp='$otp'";
                    if($conn->query($sql)){
                        $_SESSION['resetemail'] = $semail;
                        $flag = true;
                        sendResetMail($semail, $link, $otp);
                    } else {
                        $_SESSION['resetemail'] = "";
                        $_SESSION['err_msg'] = $conn->error;
                        $flag = false;
                    }
                } else {
                    echo "<script>alert('Login Failed !');</script>";
                    $_SESSION['err_msg'] = $conn->error;
                }
    
            } else {
                echo "<script>alert('Please Enter Email or Password!');</script>";
                $_SESSION['err_msg'] = "Please Enter Email or Password!";
    
            }
    } 
    
    else if(isset($_POST['resetbyotp'])) {
        if($_POST['otp'] != ""){
            $otp = $_POST['otp'];
            $sql = "SELECT email, otp FROM forgotpass WHERE email='{$_SESSION['resetemail']}' AND otp='$otp'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();

                    $_SESSION['resetemail'] = $row['email'];
                    $_SESSION['resetotp'] = $row['otp'];
                    header('location:./resetpassword.php');
                } else {
                    $_SESSION['err_msg'] = "Wrong OTP";
                    $flag = true;
                }
            
        }

    }
    
    else if(isset($_GET['resetbylink'])){
        if(
            $_GET['resetbylink'] == true and
            $_GET['link'] != ""
        ){
            $link = $_GET['link'];
            $sql = "SELECT email, otp FROM forgotpass WHERE link='$link'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    if(md5($row['email'].$row['otp']) == $link){
                        $_SESSION['resetemail'] = $row['email'];
                        $_SESSION['resetotp'] = $row['otp'];
                        header('location:./resetpassword.php');
                    }
                    
                } else {
                    $flag = false;
                    $_SESSION['resetemail'] = "";
                    $_SESSION['err_msg'] = "Wrong OTP";
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
    <link rel="stylesheet" href="..\vendor\bootstrap-4.0.0-dist\css\bootstrap.min.css">
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>

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
      
          <div class="login-div" style="align-self:center; margin-top:2%;margin-bottom:2%;">
                <a href="./index.php" class="arrow"><i class="fa fa-arrow-left"></i> Back to Login</a>
              <?php
              if($flag == false){
              ?>
                <form action="forgotpassword.php" method="post" class="login" id="login-form">
                  <fieldset>
                      <legend>Reset Password</legend>
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
                      <input type="submit" name="reset" value="Reset Password" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
              <?php
              } else {
              ?>
                <form action="forgotpassword.php" method="post" class="login" id="login-form">
                  <fieldset>
                      <legend>Reset Password</legend>
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
                      <label for="otp">OTP :</label>
                      <input type="text" name="otp" id="otp" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="submit" name="resetbyotp" value="Reset Password" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
              <?php
              }
              ?>
          </div>
          
      </div>
   </div> 
   
</body>
</html>