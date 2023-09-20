<?php
session_start();

if(isset($_SESSION['l_username'])){
    session_destroy();
    echo "<script> location.href = 'login.php' </script>";
} else {
    echo "<script> alert('Do not access directly from the URL!'); </script>";
    echo "<script> location.href = 'login.php' </script>";
}
?>
