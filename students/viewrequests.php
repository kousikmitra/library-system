<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_GET['cancel']) and
    $_GET['cancel'] != "") {
        $sql ="UPDATE requests SET status='3' WHERE id='{$_GET['cancel']}'";
        if($conn->query($sql)){
            echo "<script>alert('Succesfully Canceled'); window.location = './viewrequests.php';</script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once "./includes/bootstrap.php" ?>
    <link rel="stylesheet" href=".\css\common.css">
    <link rel="stylesheet" href=".\css\viewrequests.css">
    <title><?php echo "Requests | {$_SESSION['name']}"; ?></title>
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
                    <div class="requests-result">

                    <?php
                   
                    $sql = "SELECT id, requests.callno AS \"callno\", title, author, DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, status FROM requests, books WHERE requests.callno=books.callno AND s_id='{$_SESSION['id']}' ORDER BY req_date DESC, req_time DESC";
                
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                    ?>
                        <table class="result table">
                            <thead>
                                <td>Sr. No</td>
                                <td>Request No.</td>
                                <td>Call No.</td>
                                <td>Book Title</td>
                                <td>Author Name</td>
                                <td>Request Date</td>
                                <td>Request Time</td>
                                <td>Status</td>
                                <td>Action</td>
                            </thead>
                    <?php
                    $srno = 0;
                    while($row = $result->fetch_assoc()) {
                        $srno++;

                    ?>
                            <tr>
                                <td><?php echo "$srno"; ?></td>
                                <td><?php echo "{$row['id']}"; ?></td>
                                <td><?php echo "{$row['callno']}"; ?></td>
                                <td><a href="<?php echo "./book_details.php?callno={$row['callno']}"; ?>"><?php echo "{$row['title']}"; ?></a></td>
                                <td><?php echo "{$row['author']}"; ?></td>
                                <td><?php echo "{$row['req_date']}"; ?></td>
                                <td><?php echo "{$row['req_time']}"; ?></td>
                                <?php
                                if($row['status'] == 0){
                                ?>
                                <td><a link="#" style="color:blue">Active</a></td>
                                <?php
                                } else if($row['status'] == 1) {
                                ?>
                                <td><a link="#" style="color:green">Issued</a></td>
                                <?php
                                } else if($row['status'] == 2) {
                                ?>
                                <td><a link="#" style="color:red">Canceled By Librarian</a></td>
                                <?php
                                } else if($row['status'] == 3) {
                                ?>
                                <td><a link="#" style="color:red">Canceled By You</a></td>
                                <?php
                                }
                                ?>
                                <?php
                                if($row['status'] == 0){
                                ?>
                                <td><a href="./viewrequests.php?cancel=<?php echo "{$row['id']}"; ?>" style="color:blue"><i class="fa fa-close"></i></a></td>
                                <?php
                                } else if($row['status'] == 1){
                                ?>
                                <td><a link="#" style="color:green"><i class="fa fa-check-circle"></i></a></td>
                                <?php
                                } else {
                                ?>
                                <td><a link="#" style="color:red"><i class="fa fa-exclamation-circle"></i></a></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                    }
                    ?>
                        </table>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger">
                        <strong>Not Found!</strong> No information found.
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>