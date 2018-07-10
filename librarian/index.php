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
        <link rel="stylesheet" href=".\css\index.css">
        <?php include_once "./includes/bootstrap.php"; ?>
        <title>Librarian Login</title>
    </head>

    <body>
        <div class="main">
            <div class="login">
                <form action="index.php" method="post" id="login-form">
                    <fieldset>
                        <legend>Login</legend>
                        <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                            <div class="alert alert-danger">
                                <strong>
                                    <?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?>
                                </strong>
                            </div>
                            <?php
                      }
                      ?>
                                <div class="form-group">
                                    <label for="email">Email /User Id:</label>
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
                    <p>
                        <a href="./forgotpassword.php">forgot password?</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
    </html>