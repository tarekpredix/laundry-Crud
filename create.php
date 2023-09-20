<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clothType = $_POST['cloth_type'];
    $quantity = $_POST['quantity'];
    $userName = $_POST['user_name'];

    
    if (!preg_match('/^[1-9][0-9]*$/', $quantity)) {
        echo "<script> alert('Please enter a valid quantity.')</script>";
        echo "<script> location.href = 'index.php' </script>";

    }

    
    if (!preg_match('/[A-Za-z .]{3,20}/', $userName)) {
        echo "<script> alert('Please enter a valid username.')</script>";
        echo "<script> location.href = 'index.php' </script>";
        
    }




    if (isset($_FILES['image'])) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageFileName = $_FILES['image']['name'];
        $imagePath = 'uploads/' . $imageFileName;
    
        
       
        mysqli_query($conn, "INSERT INTO laundryms (cloth_type, quantity, user_name, image) VALUES ('$clothType', '$quantity', '$userName', '$imagePath')");
        move_uploaded_file($imageTmpName, $imagePath);
        header("Location: index.php");
    exit();
} else {
    echo "<script> alert('Please select an image.'); </script>";
    echo "<script> location.href = 'index.php'; </script>";
    exit();
}

}
