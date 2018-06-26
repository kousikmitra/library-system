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
    
    <title>Panskura Banamali College</title>
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
              </break> 
              </h1>
                  
          </div>
          <div class="top-bar-left">

          </div>
      </div>
      <div class="slide-show">
      <img src=".\images\topbar.jpg" alt="Image">
     
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
                  <p><a href="#">forgot password?</a></p>
                  <p>New here?<a href="./registration.php"> Register</a></p>
              </div>
          </div>
          
      </div>
   </div> 
   <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</body>
</html>