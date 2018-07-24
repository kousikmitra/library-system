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
        <link rel="stylesheet" href="./css/search.css">
        <link rel="stylesheet" href="./css/view-book-requests.css">
        <?php include_once "./includes/bootstrap.php"; ?>
        <title>View Book Requests</title>
    </head>

    <body>
        <div class="main">
            <?php include "includes/topbar.php"; ?>

            <div class="content">
            <div class="search-section">
                        <form action="" method="get" class="form-inline">
                        <h5 class="mr-sm-4">Search Students</h5>
                            <select name="searchby" id="search-by" class="form-control mr-sm-4">
                                <option value="name">Name</option>
                                <option value="student_id">Student ID</option>
                            </select>
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Search Keyword" value="<?php echo isset($_SESSION['search_key'])? $_SESSION['search_key'] : ""; ?>" class="form-control mr-sm-4" required>
                            <input type="submit" value="Search" name="search" class="btn btn-primary mr-sm-4">
                        </form>
                    </div>
                <div class="data">
                    <?php
                   
                   $sql = "SELECT id, s_id, requests.callno AS \"callno\", title, author, DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, status FROM requests, books WHERE requests.callno=books.callno ORDER BY req_date, req_time";
                   if(isset($_GET['search'])){
                    $searchby = $_GET['searchby'];
                    $keyword = $_GET['keyword'];
                    $_SESSION['search_key'] = $_GET['keyword'];
                    $_SESSION['searchby'] = $_GET['searchby'];
                
                    if($searchby === "name") {
                        $sql = "SELECT id, requests.s_id AS \"s_id\", requests.callno AS \"callno\", title, author, DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, status FROM requests, books, student WHERE requests.callno=books.callno AND requests.s_id=student.s_id AND student.s_name like '%$keyword%' ORDER BY req_date, req_time";
                    } elseif($searchby === "student_id") {
                        $sql = "SELECT id, s_id, requests.callno AS \"callno\", title, author, DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, status FROM requests, books WHERE requests.callno=books.callno AND requests.s_id like '%$keyword%' ORDER BY req_date, req_time";
                    } else {
                        $sql = "SELECT id, s_id, requests.callno AS \"callno\", title, author, DATE_FORMAT(req_date,'%d %b %Y') AS \"req_date\", req_time, status FROM requests, books WHERE requests.callno=books.callno ORDER BY req_date, req_time";
                    }
                }
                   $result = $conn->query($sql);
                   if($result->num_rows > 0){
                   ?>
                        <table class="result table">
                            <thead>
                                <td>Sr. No</td>
                                <td>Request No.</td>
                                <td>Student Id</td>
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
                        if($row['status'] == 0){

                    ?>
                                <tr>
                                    <td>
                                        <?php echo "$srno"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['id']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['s_id']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['callno']}"; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo " ./book_details.php?callno={$row[ 'callno']} "; ?>">
                                            <?php echo "{$row['title']}"; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo "{$row['author']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['req_date']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['req_time']}"; ?>
                                    </td>
                                    <?php
                                if($row['status'] == 0){
                                ?>
                                        <td>
                                            <a link="#" style="color:blue">Active</a>
                                        </td>
                                        <?php
                                }
                                ?>
                                                        <?php
                                if($row['status'] == 0){
                                ?>
                                                            <td>
                                                                <a href="./issue-book.php?issue=<?php echo "{$row[ 'id']}"; ?>" style="color:green">
                                                                    <i class="fa fa-check"></i>
                                                                </a> &nbsp
                                                                <a href="./view-book-requests.php?cancel=<?php echo " {$row[ 'id']}"; ?>" style="color:red">
                                                                    <i class="fa fa-close"></i>
                                                                </a>
                                                            </td>
                                                            <?php
                                }
                                ?>
                                </tr>
                                <?php
                        }
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

    </body>

    </html>