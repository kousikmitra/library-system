<?php
session_start();
include_once "./includes/functions.php";
if(!isLoggedIn()){
    header('location:./index.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".\css\common.css">
    <link rel="stylesheet" href=".\css\home.css">
    <?php include_once "./includes/bootstrap.php"; ?>
    <title><?php echo "Home | {$_SESSION['name']}"; ?></title>
</head>
<body>

    <div class="main">
   
        <?php include "./includes/topbar.php"; ?>
        </div>
        <div class="main-content">
        
            <?php include "./includes/sidebar.php"; ?>
            <div class="content">
                <div class="header">
                    <h1>College Library Management System</h1>
                </div>
                <div class="main-menu">
                    <div class="item1">
                        <h5><a href="#">Find Books</a></h5>
                    </div>
                    <div class="item2">
                    <h5><a href="#">Find Books</a></h5>
                    </div>
                    <div class="item3">
                    <h5><a href="#">Find Books</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>