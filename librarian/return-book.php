<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_POST['return_book'])){
    $accno = $_POST['acc_no'];

    $sql = "SELECT * FROM issue WHERE acc_no='$accno'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $sql = "INSERT INTO return_books(req_id, s_id, callno, acc_no, issue_date, returned_date)
                 VALUES ('{$row['req_id']}','{$row['s_id']}','{$row['callno']}','{$row['acc_no']}','{$row['issue_date']}',CURDATE())";
        if($conn->query($sql)){
            $sql = "DELETE FROM issue WHERE acc_no='{$row['acc_no']}'";
            if($conn->query($sql)){
                echo "<script>alert('Return Successful!'); window.location = './return-book.php';</script>";
            }
        }
    }
}

if(isset($_POST['cancel_req'])){
    $reqid = $_POST['req_id'];
    $sql ="UPDATE requests SET status='2' WHERE id='$reqid'";
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
        <title>Return Book</title>
        <style>
            .content{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items : center;
            }

            .addbook-form{
                width: 60%;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <?php include "includes/topbar.php"; ?>

            <div class="content">
                <h1>Return Book</h1>
                <div class="addbook-form">
                <form action="" method="post">
                    <table class="table">
                        <tr>
                            <td><label for="acc_no">Enter Acc No.</label></td>
                            <td><input class="form-control" type="text" name="acc_no" id="acc_no"></td>
                            <td><input class="btn btn-primary" type="submit" name="return_book" id="return_book" value="Return Book"></td>
                        </tr>
                    </table>
                </form>
                <hr>
                <form action="./return-book-sid.php" method="get">
                    <table class="table">
                        <tr>
                            <td><label for="s_id">Enter Student ID</label></td>
                            <td><input class="form-control" type="text" name="s_id" id="s_id"></td>
                            <td><input class="btn btn-primary" type="submit" name="search_issued_book" id="search_issued_book" value="Search By ID"></td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>

    </body>

    </html>