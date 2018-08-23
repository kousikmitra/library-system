<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(!isset($_GET['callno'])){
    header('location:./search.php');
} else {
    $callno = $_GET['callno'];
    $sql = "SELECT * FROM books, category, availability WHERE books.callno = availability.callno AND books.callno = category.callno AND books.callno like '%$callno%'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}

if(isset($_POST['request'])){
    
    $sql = "INSERT INTO requests (s_id, callno, req_date, req_time) VALUES ('{$_SESSION['id']}', '{$_POST['callno']}', CURDATE(), CURTIME())";
    if($conn->query($sql)){
        $sql = "SELECT title FROM books WHERE callno='{$_POST['callno']}'";
        $row = $conn->query($sql)->fetch_assoc();
        sendRequestMail($_SESSION['email'], $row['title']);
        echo "<script>alert('Book Request Send'); window.location = './book_details.php?callno={$_POST['callno']}';</script>";
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
    <?php include_once "./includes/bootstrap.php"; ?>
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
                                <div><img src="<?php echo $row['image']; ?>" alt="Book" width="150" height="200"></div>
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
                                        <td>
                                        <?php
                                        if($row['total'] > 0){
                                            $sql = "SELECT id FROM requests WHERE s_id='{$_SESSION['id']}' AND callno='{$row['callno']}' AND status='0'";
                                            $result = $conn->query($sql);
                                            if($result->num_rows > 0){
                                        ?>
                                        <button class="btn btn-secondary" style="background:#068593; color:white;">Already Requested</button>
                                        <?php
                                            } else {
                                        ?>
                                        <form action="" method="post">
                                        <input type="hidden" id="callno" name="callno" value="<?php echo $row['callno']; ?>">
                                        <input type="submit" value="Request Book" name="request" class="btn btn-primary">
                                        </form>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                        <button class="btn btn-secondary">Not Available</button>
                                        <?php
                                        }
                                        ?>
                                        </td>
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
                            <h4>Related Books :</h4>
                            <table class="table">
                            <?php
                            while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td><img src="<?php echo $row['image']; ?>" alt="" height=50 width=50></td>
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
</body>
</html>