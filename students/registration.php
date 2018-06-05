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
      <div class="content">
          <div class="registration-div">
              <form action="#" class="registration-form">
                  <fieldset style="border: 1px solid #007BFF; padding: 20px;">
                      <legend style="width: auto;">New Registration</legend>
                      <div class="form-group">
                          <label for="name">Name :</label>
                          <input type="text" name="name" id="name" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="email">Email :</label>
                          <input type="email" name="email" id="email" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="password">New Password :</label>
                          <input type="password" name="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="confirm-password">Confirm Password :</label>
                          <input type="password" name="confirm_password" id="confirm-password" class="form-control">
                      </div>
                  </fieldset>
              </form>
          </div>
      </div>
    </div>
    
</body>
<script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</html>