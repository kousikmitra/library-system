<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_GET['issue'])){
    $sql = "SELECT id, requests.s_id AS \"s_id\", requests.callno AS \"callno\", title, author,
             DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, student.s_name AS \"s_name\", status
             FROM requests, books, student
             WHERE requests.callno=books.callno AND requests.s_id = student.s_id AND requests.id = '{$_GET['issue']}'";

    $info = $conn->query($sql)->fetch_assoc();


}

if(isset($_POST['issue_book'])){
    $reqid = $_POST['req_id'];
    $sid = $_POST['s_id'];
    $callno = $_POST['callno'];
    $accno = $_POST['acc_no'];

    $sql = "INSERT INTO issue(req_id, s_id, callno, acc_no, issue_date, issue_time, return_date)
             VALUES ('$reqid', '$sid', '$callno', '$accno', CURDATE(), CURTIME(), DATE_ADD(CURDATE(), INTERVAL 10 DAY))";

    if($conn->query($sql)){
        $sql = "UPDATE requests SET status='1' WHERE id='$reqid'";
        $conn->query($sql);
        echo "<script>alert('Issue Successful!'); window.location = './view-book-requests.php';</script>";
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
        <title>Issue Book</title>
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
                <h1>Issue Book</h1>
                <div class="addbook-form">
                <form action="" method="post">
                    <table class="table">
                        <tr>
                            <td><label for="req_id">Request No.</label></td>
                            <td><input class="form-control" type="text" name="req_id" id="req_id" value="<?php echo $info['id']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="s_id">Student ID</label></td>
                            <td><input class="form-control" type="text" name="s_id" id="s_id" value="<?php echo $info['s_id']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="s_name">Student Name</label></td>
                            <td><input class="form-control" type="text" name="s_name" id="s_name" value="<?php echo $info['s_name']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="callno">Call No.</label></td>
                            <td><input class="form-control" type="text" name="callno" id="callno" value="<?php echo $info['callno']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title">Book Title</label></td>
                            <td><input class="form-control" type="text" name="title" id="title" value="<?php echo $info['title']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="req_date">Request Date</label></td>
                            <td><input class="form-control" type="text" name="req_date" id="req_date" value="<?php echo $info['req_date']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="issue_date">Issue Date</label></td>
                            <td><input type="text" class="form-control" name="issue_date" id="issue_date" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date('d-M-Y'); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="issue_time">Issue Time</label></td>
                            <td><input type="text" class="form-control" name="issue_time" id="issue_time" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("h:i:sa"); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="return_date">Return Date</label></td>
                            <td><input class="form-control" type="text" name="return_date" id="return_date" value="<?php $date=date_create(date('d-M-Y'));
date_add($date,date_interval_create_from_date_string("10 days"));
echo date_format($date,"Y-m-d"); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="acc_no">Enter Acc No.</label></td>
                            <td><input class="form-control" type="text" name="acc_no" id="acc_no"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-primary" type="submit" name="issue_book" id="issue_book" value="Issue Book">
                            <input class="btn btn-primary" type="submit" name="cancel_req" id="cancel-req" value="Cancel Request"></td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>

    </body>

    </html>