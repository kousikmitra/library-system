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
                        <div class="upper-section">
                            <div class="book-img">
                                <div><img src="./bookimg/book.jpg" alt="Book" width="150" height="200"></div>
                            </div>
                            <div class="book-info">
                                <table class="table">
                                    <tr>
                                        <td>Book Title</td>
                                        <td><?php echo $row['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Author Name</td>
                                        <td><?php echo $row['author']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td><?php echo $row['publisher']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo $row['description']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Call No.</td>
                                        <td><?php echo $row['callno']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Availability</td>
                                        <td><?php echo $row['total']; ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><a href="#" class="btn btn-primary">Request Book</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

<?php
    $sql = "SELECT distinct title, author, books.callno as \"callno\", image FROM books, category, availability WHERE books.callno = availability.callno AND books.callno = category.callno AND
             books.{$_SESSION['searchby']} like '%{$_SESSION['search_key']}%'";
    $result = $conn->query($sql);
    
?>


                        <div class="lower-section">
                            <h6>Related Books :</h6>
                            <table>
                            <?php
                            while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td><a href="./book_details.php?callno=<?php echo $row['callno']; ?>"><?php echo $row['title']; ?></a></td>
                                <td><?php echo $row['author']; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="..\vendor\bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
</body>
</html>