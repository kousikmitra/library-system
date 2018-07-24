<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_GET['unblock'])){
    $sql ="SELECT s_id FROM student WHERE s_id='{$_GET['unblock']}'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $sql = "UPDATE student SET s_status = 1 WHERE s_id='{$_GET['unblock']}'";
        if($conn->query($sql)){
            echo "<script>alert('Student Unblocked!'); window.location = './find-students.php';</script>";
        }
    }
}

if(isset($_GET['block'])){
    $sql ="SELECT s_id FROM student WHERE s_id='{$_GET['block']}'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $sql = "UPDATE student SET s_status = 2 WHERE s_id='{$_GET['block']}'";
        if($conn->query($sql)){
            echo "<script>alert('Student Blocked!'); window.location = './find-students.php';</script>";
        }
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
    <?php include "./includes/bootstrap.php"; ?>
    <title><?php echo "Find Student | {$_SESSION['name']}"; ?></title>
</head>
<body>
<div class="main">
        <?php include "./includes/topbar.php"; ?>
        </div>
        <div class="main-content">
            <div class="content">
                <div class="header">
                    <h1>College Library Management System</h1>
                </div>
                <div class="main-menu">
                    <div class="search-section">
                        <form action="" method="get" class="form-inline">
                        <h5 class="mr-sm-4">Search Students</h5>
                            <select name="searchby" id="search-by" class="form-control mr-sm-4">
                                <option value="name">Name</option>
                                <option value="student_id">Student ID</option>
                                <option value="reg_year">Reg. Year</option>
                                <option value="dept">Department</option>
                            </select>
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Search Keyword" value="<?php echo isset($_SESSION['search_key'])? $_SESSION['search_key'] : ""; ?>" class="form-control mr-sm-4" required>
                            <input type="submit" value="Search" name="search" class="btn btn-primary mr-sm-4">
                        </form>
                    </div>
                    <div class="search-result">

                    <?php
                        $sql = "SELECT * FROM student";
                        if(isset($_GET['search'])){
                            $searchby = $_GET['searchby'];
                            $keyword = $_GET['keyword'];
                            $_SESSION['search_key'] = $_GET['keyword'];
                            $_SESSION['searchby'] = $_GET['searchby'];
                        
                            if($searchby === "name") {
                                $sql = "SELECT * FROM student WHERE s_name like '%$keyword%'";
                            } elseif($searchby === "student_id") {
                                $sql = "SELECT * FROM student WHERE s_id like '%$keyword%'";
                            } elseif($searchby === "reg_year") {
                                $sql = "SELECT * FROM student WHERE s_regyear like '%$keyword%'";
                            } elseif($searchby === "dept") {
                                $sql = "SELECT * FROM student WHERE s_dept like '%$keyword%'";
                            } else {
                                $sql = "SELECT * FROM student";
                            }
                        }
                        
                    
                        $result = $conn->query($sql);
                    if($result->num_rows > 0){
                    ?>
                        <table class="result table">
                            <thead>
                                <td>Sr. No</td>
                                <td>Student ID</td>
                                <td>Student Name</td>
                                <td>Student Email</td>
                                <td>Student Phone</td>
                                <td>Student Dept</td>
                                <td>Student Reg.</td>
                                <td>Student Reg. Year</td>
                                <td>Action</td>
                            </thead>
                    <?php
                    $srno = 0;
                    while($row = $result->fetch_assoc()) {
                        $srno++;
                    ?>
                            <tr>
                                <td><?php echo "$srno"; ?></td>
                                <td><a href="<?php echo "./book_details.php?callno={$row['s_id']}"; ?>"><?php echo "{$row['s_id']}"; ?></a></td>
                                <td><?php echo "{$row['s_name']}"; ?></td>
                                <td><?php echo "{$row['s_email']}"; ?></td>
                                <td><?php echo "{$row['s_phone']}"; ?></td>
                                <td><?php echo "{$row['s_dept']}"; ?></td>
                                <td><?php echo "{$row['s_regno']}"; ?></td>
                                <td><?php echo "{$row['s_regyear']}"; ?></td>
                                <?php
                                if($row['s_status'] == 1){
                                ?>
                                <td>
                                <a href="<?php echo "./view-students-for-approval.php?block="."{$row['s_id']}"; ?>" class="btn btn-danger" style="color:white">Block</a>
                                </td>
                                <?php
                                } else {
                                    ?>
                                    <td><a href="<?php echo "./view-students-for-approval.php?activate="."{$row['s_id']}"; ?>" class="btn btn-success" style="color:white">Unblock</a></td>
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
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</body>
</html>