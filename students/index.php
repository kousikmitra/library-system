<?php
    
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
          <img src=".\images\slideshow.jpg" alt="Image">
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
              <form action="#" class="login" id="login-form">
                  <fieldset>
                      <legend>Login</legend>
                  <div class="form-group">
                      <label for="email">Email :</label>
                      <input type="text" name="email" id="email" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="password">Password :</label>
                      <input type="password" name="password" id="password" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="button" name="login" value="login" class="form-control btn btn-primary">
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
</body>
<script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</html>