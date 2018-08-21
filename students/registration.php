<?php
session_start();
$_SESSION['err_msg'] = "";
if(isset($_POST['submit'])) {
    include_once "./includes/dbconnection.php";
    
    $sid = $_POST['id'];
    $sname = $_POST['name'];
    $semail = $_POST['email'];
    $sphone = $_POST['phone'];
    $sdept = $_POST['department'];
    $sregno = $_POST['reg_no'];
    $sregyear = $_POST['reg_year'];
    $spassword = md5($_POST['password']);

    if($sid != ""
        and $sname != ""
        and $semail != ""
        and $sphone != ""
        and $sdept != ""
        and $sregno != ""
        and $sregyear != ""
        and $spassword != ""
        ) {

            $sql = "INSERT INTO student (s_id, s_name, s_email, s_password, s_phone, s_dept, s_regno, s_regyear) VALUES (
                        '$sid', '$sname', '$semail', '$spassword', '$sphone', '$sdept', '$sregno', '$sregyear')";
            
            if($conn->query($sql)){
                echo "<script>alert('Registration Completed !');</script>";
                header('location:./index.php');
            } else {
                echo "<script>alert('Registration Failed !;</script>";
                $_SESSION['err_msg'] = $conn->error;
            }

        } else {
            echo "<script>alert('Please Fill The Form!');</script>";
            $_SESSION['err_msg'] = "Please Fill The Form!";

        }



}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="..\vendor\bootstrap-4.0.0-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href=".\css\registration.css">
    <title>New Registration</title>
</head>
<body>
    <div class="main">
        <div class="status-bar">
        <div class="marquee">
                <marquee behavior="" direction="">Welcome To Our College Central Library. </marquee>
            </div>
        </div>
        <div class="top-bar">
          <div id="title">
          <img src="./images/logo.jpg" alt="Panskura Banamali College" height=120>
          </div>
          <div class="top-bar-right">

          </div>
      </div>
      <div class="content">
          <div class="registration-div">
              <form action="registration.php" method="post" class="registration-form">
                  <fieldset style="border: 1px solid #007BFF; padding: 20px;">
                      <legend style="width: auto; padding: 10px;">New Registration</legend>
                      <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                      <div class="alert alert-danger">
                          <strong>Error!</strong>
                          <?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?>
                      </div>
                      <?php
                      }
                      ?>
                      <div class="form-group">
                      *Fill all the field properly </br>
                          <label for="name">Name :</label>
                          <input type="text" name="name" id="name" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="id">ID Card No :</label>
                          <input type="text" name="id" id="id" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="email">Email(It's use your User Id.) :</label>
                          <input type="email" name="email" id="email" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="phone">Phone :</label>
                          <input type="number" name="phone" id="phone" class="form-control">  
                      </div>
                      <div class="form-group">
                          <label for="department">Department :</label>
                          <select name="department" id="department" class="form-control">
                              <option value="COSH">Computer Science</option>
                              <option value="BCA">BCA</option>
                              <option value="BENH">Bengali</option>
                              <option value="ENGH">English</option>
                              <option value="HISH">History</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="reg-no">Registration No :</label>
                          <input type="text" name="reg_no" id="reg-no" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="reg-year">Registration Year (e.g. 2014-2015) :</label>
                          <input type="text" name="reg_year" id="reg-year" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="password">New Password :</label>
                          <input type="password" name="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="confirm-password">Confirm Password :</label>
                          <input type="password" name="confirm_password" id="confirm-password" class="form-control">
                      </div>
                      <div class="form-group">
                          <input type="submit" name="submit" value="Register" id="submit" class="btn btn-primary">
                      </div>
                  </fieldset>
              </form>
          </div>
      </div>
    </div>
    
</body>
<script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</html>