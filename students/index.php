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
            <div class="status-bar">
            </div>

            <div class="top-bar">
                <div id="title">
                    <img src="./images/logo.jpg" alt="Panskura Banamali College" height=120>
                </div>
                <div class="top-bar-right">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" a href="./index.php">Home</a>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ndl.iitkgp.ac.in/">NDL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://library.vidyasagar.ac.in/ereferences/OnlineNewsPaper.aspx">e-NEWS PAPER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://librarypbc.org/contact/">CONTACT</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Important links</a>
                            <a class="dropdown-item" href="http://panskurabanamalicollege.org/status-of-the-college.php">Status of College</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Service</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
                </div>
            </div>
            <div class="slide-show">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="./images/3rd.jpg" alt="First slide">
                            
                            <div class="carousel-caption d-none d-md-block">
                                <h2>
                                    <i class="fa fa-quote-left"></i> A library is like an island in the middle of vast sea of ignorance, particularly
                                    if the library is very tall and surrounding area has been flooded.
                                    <i class="fa fa-quote-right"></i>
                                </h2>
                                <strong style="float:right;">~ Lemony Snicket</strong>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./images/1st.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>
                                    <i class="fa fa-quote-left"></i> Libraries are more important to the education system than the institutions such
                                    as schools, colleges and universities.
                                    <i class="fa fa-quote-right"></i>
                                </h2>
                                <strong style="float:right;">~ Rabindranath Tagore</strong>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./images/slide2.jpg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>
                                    <i class="fa fa-quote-left"></i> The only thing that you absolutely have to know is the location of the library.
                                    <i class="fa fa-quote-right"></i>
                                </h2>
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
            </div>
            <div class="marquee">
                <marquee behavior="" direction="">Welcome To Our College Central Library. </marquee>
            </div>
            <div class="content">
                <div class="notification-left">
                    
                    <p><i>Welcome To Our College Central Library which is more comprised of many old books whose valuation is not possible.And that helps all of you to find all your books.</i>
                    </p>
                </div>
                <div class="notification-right">
             <center><b>Notice Board</b></center>
             <hr>
             <marquee behavior="" direction="up" style="color:blue;">
             <ul>
             <li><p>BCA final semester exam routine published</p></li>
             <li><p>A workshop will held on 24.08.18 about Cyber crime,intersted candidates contact with BCA Department</p></li>
             <li><p>New latest journals arrive</p></li>
             </ul>
             </marquee>
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
                        <p>New here?
                            <a href="./registration.php"> Register</a>
                        </p>
                       
                    </div>
                </div>

            </div>
        </div>
        <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
    </body>

    </html>