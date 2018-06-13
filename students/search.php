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
    <link rel="stylesheet" href="..\vendor\bootstrap-4.0.0-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="..\vendor\fontawesome-free-5.0.13\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome.min.css">
    <link rel="stylesheet" href=".\css\search.css">
    <link rel="stylesheet" href=".\css\common.css">
    <title><?php echo "Search | {$_SESSION['name']}"; ?></title>
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
                    <div class="search-section">
                        <form action="" method="get" class="form-inline">
                        <h5 class="mr-sm-4">Search Books</h5>
                            <select name="searchby" id="search-by" class="form-control mr-sm-4">
                                <option value="title">Title</option>
                                <option value="author">Author</option>
                                <option value="category">Category</option>
                                <option value="callno">Call No.</option>
                            </select>
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Search Keyword" class="form-control mr-sm-4" required>
                            <input type="submit" value="Search" name="search" class="btn btn-primary mr-sm-4">
                        </form>
                    </div>
                    <div class="search-result">

                    <?php
                    if(isset($_GET['search'])) {
                        include_once "./includes/dbconnection.php";
                    
                        $searchby = $_GET['searchby'];
                        $keyword = $_GET['keyword'];
                    
                        if($searchby === "title") {
                            $sql = "SELECT * FROM books, availability WHERE books.callno = availability.callno AND books.title like '%$keyword%'";
                        } elseif($searchby === "author") {
                            $sql = "SELECT * FROM books, availability WHERE books.callno = availability.callno AND books.author like '%$keyword%'";
                        } elseif($searchby === "category") {
                            $sql = "SELECT * FROM books, category, availability WHERE books.callno = availability.callno AND books.callno = category.callno AND category.name like '%$keyword%'";
                        } elseif($searchby === "callno") {
                            $sql = "SELECT * FROM books, availability WHERE books.callno = availability.callno AND books.callno like '%$keyword%'";
                        } else {
                    
                        }
                    
                        $result = $conn->query($sql);
                    if($result->num_rows > 0){
                    ?>
                        <table class="result table">
                            <thead>
                                <td>Sr. No</td>
                                <td>Call No.</td>
                                <td>Book Title</td>
                                <td>Author Name</td>
                                <td>Publisher</td>
                                <td>Availability</td>
                            </thead>
                    <?php
                    $srno = 0;
                    while($row = $result->fetch_assoc()) {
                        $srno++;
                    ?>
                            <tr>
                                <td><?php echo "$srno"; ?></td>
                                <td><?php echo "{$row['callno']}"; ?></td>
                                <td><a href="<?php echo "./book_details.php?callno={$row['callno']}"; ?>"><?php echo "{$row['title']}"; ?></a></td>
                                <td><?php echo "{$row['author']}"; ?></td>
                                <td><?php echo "{$row['publisher']}"; ?></td>
                                <?php
                                if($row['total'] > 0){
                                ?>
                                <td><a link="#" class="btn btn-success" style="color:white">Available <?php echo "{$row['total']}"; ?></a></td>
                                <?php
                                } else {
                                ?>
                                <td><a link="#" class="btn btn-secondary" style="color:white">Not Available <?php echo "{$row['total']}"; ?></a></td>
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