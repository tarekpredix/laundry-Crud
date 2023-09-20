<?php
include 'config.php';

$r_username = $_POST['r_username'];
$r_email = $_POST['r_email'];
$r_mobile = $_POST['r_mobile'];
$r_pass = $_POST['r_pass'];
$r_con_pass = $_POST['r_con_pass'];

$username_pattern = "/[A-Za-z .]{3,20}/"; //optional, limit
$email_pattern = "/[a-z0-9]+@(gmail|yahoo|hotmail)\.com/"; //+er pore must first br 
$mobile_pattern = "/(\+88)?-?01[3-9]\d{8}/";
$pass_pattern = "/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/"; //Minimum eight characters, at least one uppercase letter, one lowercase letter, and one number

$insertQuery = "INSERT INTO `laundry`(`db_username`, `db_email`, `db_mobile`, `db_pass`) VALUES ('$r_username','$r_email','$r_mobile','$r_pass')"; // inserts the user's registration data into the database table laundry.

$duplicateUsernameQuery = "SELECT * FROM `laundry` WHERE db_username='$r_username'"; //Before inserting, it checks for duplicate usernames by executing the query $duplicateUsernameQuery and fetching the results with $duplicate_username.

$duplicate_username = mysqli_query($conn, $duplicateUsernameQuery);

if (mysqli_num_rows($duplicate_username) > 0) {
    echo "<script> alert('Username Exists') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if (!preg_match($username_pattern, $r_username)) {
    echo "<script> alert('only char (3-20)') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if (!preg_match($email_pattern, $r_email)) {
    echo "<script> alert('only accept lus mail') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if (!preg_match($mobile_pattern, $r_mobile)) {
    echo "<script> alert('only bd phone number') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if (!preg_match($pass_pattern, $r_pass)) {
    echo "<script> alert('Minimum eight characters, at least one uppercase letter, one lowercase letter, and one number') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if ($r_pass != $r_con_pass) {
    echo "<script> alert('Password is not matched') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else if (!mysqli_query($conn, $insertQuery)) {
    echo "<script> alert('Not Registered') </script>";
    echo "<script> location.href = 'register.php' </script>";
} else {
    echo "<script> alert('Successfully Registered') </script>";
    echo "<script> location.href = 'login.php' </script>";
}
?>
