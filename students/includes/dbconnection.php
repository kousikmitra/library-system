<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/library-system/dbinfo.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("connectoin failed :" . $conn->connect_error);
}

?>