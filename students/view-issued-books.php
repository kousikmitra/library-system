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
    <title><?php echo "Issued Books | {$_SESSION['name']}"; ?></title>
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
                   /********************** */
                    $sql = "SELECT id, issue.callno AS \"callno\", title, author, DATE_FORMAT(issue_date,'%d %b %Y') AS \"issue_date\", issue_time, DATE_FORMAT(return_date,'%d %b %Y') AS \"return_date\" FROM issue, books WHERE issue.callno=books.callno AND s_id='{$_SESSION['id']}' ORDER BY issue_date DESC, issue_time DESC";
                
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                    ?>
                        <table class="result table">
                            <thead>
                                <th>Sr. No</th>
                                <th>Request No.</th>
                                <th>Call No.</th>
                                <th>Book Title</th>
                                <th>Author Name</th>
                                <th>Issue Date</th>
                                <th>Issue Time</th>
                                <th>Return Date</th>
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
                                <td><?php echo "{$row['issue_date']}"; ?></td>
                                <td><?php echo "{$row['issue_time']}"; ?></td>
                                <td><?php echo "{$row['return_date']}"; ?></td>
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