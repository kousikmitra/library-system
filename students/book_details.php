<?php
session_start();
include_once "./includes/functions.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(!isset($_GET['callno'])){
    header('location:./search.php');
} else {
    include_once "./includes/dbconnection.php";
    $callno = $_GET['callno'];
    $sql = "SELECT * FROM books, category, availability WHERE books.callno = availability.callno AND books.callno = category.callno AND books.callno like '%$callno%'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".\css\common.css">
    <link rel="stylesheet" href=".\css\book_details.css">
    <link rel="stylesheet" href="..\vendor\bootstrap-4.0.0-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="..\vendor\fontawesome-free-5.0.13\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome.min.css">
    <title><?php echo "{$row['title']}"; ?></title>
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
                    <div class="book-details">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</body>
</html>