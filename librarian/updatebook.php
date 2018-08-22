<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_POST['addbook'])){
    $callno = $_POST['callno'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $desc = $_POST['desc'];
    $total = $_POST['total'];

    if(!($_FILES['bookimage']['error'] > 0)){
        $target_dir = "../bookimg/";
        $image = $target_dir.$callno.".jpg";
        $target_file = $target_dir . $callno.".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["bookimage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if ($_FILES["bookimage"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["bookimage"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["bookimage"]["name"]). " has been uploaded.";
                $sql = "UPDATE books SET title='$title',author='$author',publisher='$publisher',
                    description='$desc',image='$image',addedat=CURDATE() WHERE callno='$callno'";
            
                $conn->query($sql);

                $sql = "UPDATE availability SET total='$total' WHERE callno='$callno'";
                $conn->query($sql);


        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    } else {
            $sql = "UPDATE books SET title='$title',author='$author',publisher='$publisher',
                    description='$desc',addedat=CURDATE() WHERE callno='$callno'";
            
            $conn->query($sql);

            $sql = "UPDATE availability SET total='$total' WHERE callno='$callno'";
            $conn->query($sql);
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
        <title>Add New Book</title>
        <style>
            .content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .addbook-form {
                width: 60%;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <?php include "includes/topbar.php"; ?>

            <div class="content">
                <h1>Update Book Deails</h1>
                <div class="addbook-form">
                    <?php
                    if(isset($_GET['callno'])){

                        $sql = "SELECT books.callno as \"callno\", title, author, publisher, description, image, total  FROM books, availability WHERE books.callno = availability.callno AND books.callno='{$_GET['callno']}'";
                        $result = $conn->query($sql);
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <table class="table">
                                <tr>
                                    <td>
                                        <label for="callno">Call No.</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="callno" id="callno" value="<?php echo $row['callno']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="title">Title of Book</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $row['title']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="title">Author Name</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="author" id="author" value="<?php echo $row['author']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="publisher">Publisher Name</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="publisher" id="publisher" value="<?php echo $row['publisher']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="desc">Description</label>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="desc" id="desc"><?php echo $row['description']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="bookimage">Image</label>
                                    </td>
                                    <td>
                                    <?php
                            if(isset($row['image'])){
                            ?>
                                        
                                            <img src="../bookimg/<?php echo $row['image']; ?>" alt="" width=80 height=100>
                                        
                                        <?php
                            }
                            ?>
                                            
                                                <input class="form-control" type="file" name="bookimage" id="bookimage">
                                            </td>
                                            
                                </tr>
                                <tr>
                                    <td>
                                        <label for="total">Availability</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="total" id="total" value="<?php echo $row['total']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-primary" type="submit" name="addbook" id="addbook" value="Update Book">
                                        <input class="btn btn-primary" type="reset" name="resetform" id="resetform">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                <strong>Not Found!</strong> No information found.
                            </div>
                            <form action="" method="get">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label for="callno">Call No.</label>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="callno" id="callno">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input class="btn btn-primary" type="submit" name="search" id="search" value="Search">
                                            <input class="btn btn-primary" type="reset" name="resetform" id="resetform">
                                        </td>
                                    </tr>
                                </table>
                            </form>

                            <?php
                        }
                    } else {
                ?>
                                <form action="" method="get">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <label for="callno">Call No.</label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="callno" id="callno">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input class="btn btn-primary" type="submit" name="search" id="search" value="Search">
                                                <input class="btn btn-primary" type="reset" name="resetform" id="resetform">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                    }
                ?>
                </div>
            </div>
        </div>

    </body>

    </html>