<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
if(!isLoggedIn()){
    header('location:./index.php');
}

if(isset($_POST['update'])){
    $sql = "UPDATE `student` SET `s_name`='{$_POST['name']}',`s_email`='{$_POST['email']}',`s_phone`='{$_POST['phone']}' WHERE s_id='{$_SESSION['id']}'";
    if($conn->query($sql)){
        echo "<script>alert('Profile Updated Successfuly!'); window.location = './profile.php';</script>";
    }
}

$sql = "SELECT * FROM student WHERE s_id='{$_SESSION['id']}'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once "./includes/bootstrap.php" ?>
    <link rel="stylesheet" href=".\css\common.css">
    <title><?php echo "My Profile | {$_SESSION['name']}"; ?></title>
    <style>
    .main-menu{
        padding-left: 100px;
        color: white;
    }
    .main-menu{
        color: white;
    }
    </style>
</head>
<body>
<div class="main">
        <?php include "./includes/topbar.php"; ?>
        </div>
        <div class="main-content">
            <?php include "./includes/sidebar.php"; ?>
            <div class="content">
                <div class="main-menu">
                <h1>My Profile</h1>
                <form action="" method="post">
                    <table class="table">
                        <tr>
                        <td><label for="name"><h6>Name : </h6></label></td><td></td>
                        <td><input type="text" name="name" id="name" class="form-control" value="<?php echo $row['s_name']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="email"><h6>Email : </h6></label></td><td></td>
                        <td><input type="text" name="email" id="email" class="form-control" value="<?php echo $row['s_email']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="phone"><h6>Phone : </h6></label></td><td></td>
                        <td><input type="text" name="phone" id="phone" class="form-control" value="<?php echo $row['s_phone']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="dept"><h6>Department : </h6></label></td><td></td>
                        <td><input type="text" name="dept" id="dept" class="form-control" value="<?php echo $row['s_dept']; ?>" disabled></td>
                        </tr>
                        <tr>
                        <td><label for="regno"><h6>Reg. No. : </h6></label></td><td></td>
                        <td><input type="text" name="regno" id="regno" class="form-control" value="<?php echo $row['s_regno']; ?>" disabled></td>
                        </tr>
                        <tr>
                        <td><label for="regyear"><h6>Reg. Year : </h6></label></td><td></td>
                        <td><input type="text" name="regyear" id="regyear" class="form-control" value="<?php echo $row['s_regyear']; ?>" disabled></td>
                        </tr>
                        <td></td><td></td>
                        <td><input type="submit" value="Update Profile" name="update" class="btn btn-primary" style="float:right;"></td>
                        </tr>
                        <tr>
                        <td></td><td></td>
                        <td><a href="#" style="float:right;">Change Password</a></td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>