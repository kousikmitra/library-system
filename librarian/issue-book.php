<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_GET['cancel']) and
    $_GET['cancel'] != "") {
        $sql ="UPDATE requests SET status='2' WHERE id='{$_GET['cancel']}'";
        if($conn->query($sql)){
            echo "<script>alert('Succesfully Canceled'); window.location = './view-book-requests.php';</script>";
        }
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/view-book-requests.css">
        <?php include_once "./includes/bootstrap.php"; ?>
        <title>Issue Book</title>
    </head>

    <body>
        <div class="main">
            <?php include "includes/topbar.php"; ?>

            <div class="content">
                
            </div>
        </div>

    </body>

    </html>
