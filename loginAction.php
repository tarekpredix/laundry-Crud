<?php
include 'config.php';

$input_username = $_POST['l_username'];
$input_pass = $_POST['l_pass']; //retrive

$result = mysqli_query($conn, "SELECT * FROM `laundry` WHERE db_username='$input_username'");

if(mysqli_num_rows($result)){
    session_start();
    $_SESSION['l_username'] = $input_username;
    echo "<script> location.href = 'index.php' </script>";
} else {
    echo "<script> alert('Incorrect User Name and Pass') </script>";
    echo "<script> location.href = 'login.php' </script>";
}
?>
