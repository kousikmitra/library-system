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
    if ($_FILES["bookimage"]["size"] > 500000) {
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
            $sql = "INSERT INTO books(callno, title, author, publisher, description, image, addedat)
                     VALUES ('$callno','$title','$author','$publisher','$desc','$image',CURDATE())";
            
            $conn->query($sql);

            $sql = "INSERT INTO availability(callno, total) VALUES ('$callno', '$total')";
            $conn->query($sql);


        } else {
            echo "Sorry, there was an error uploading your file.";
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
        <link rel="stylesheet" href="./css/view-book-requests.css">
        <?php include_once "./includes/bootstrap.php"; ?>
        <title>Add New Book</title>
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
                <h1>Add New Book</h1>
                <div class="addbook-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td><label for="callno">Call No.</label></td>
                            <td><input class="form-control" type="text" name="callno" id="callno"></td>
                        </tr>
                        <tr>
                            <td><label for="title">Title of Book</label></td>
                            <td><input class="form-control" type="text" name="title" id="title"></td>
                        </tr>
                        <tr>
                            <td><label for="title">Author Name</label></td>
                            <td><input class="form-control" type="text" name="author" id="author"></td>
                        </tr>
                        <tr>
                            <td><label for="publisher">Publisher Name</label></td>
                            <td><input class="form-control" type="text" name="publisher" id="publisher"></td>
                        </tr>
                        <tr>
                            <td><label for="desc">Description</label></td>
                            <td><textarea class="form-control" name="desc" id="desc"></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="bookimage">Image</label></td>
                            <td><input class="form-control" type="file" name="bookimage" id="bookimage"></td>
                        </tr>
                        <tr>
                            <td><label for="availability">Availability</label></td>
                            <td><input class="form-control" type="text" name="total" id="total"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-primary" type="submit" name="addbook" id="addbook" value="Add Book">
                            <input class="btn btn-primary" type="reset" name="addbook" id="addbook"></td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>

    </body>

    </html>