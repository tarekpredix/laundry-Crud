<?php
include 'config.php';

session_start();
if (isset($_SESSION['l_username'])) {
} else {
    echo "<script> alert('Do not access directly from the URL!'); </script>";
    echo "<script> location.href = 'login.php' </script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $clothType = $_POST['cloth_type'];
    $quantity = $_POST['quantity'];
    $userName = $_POST['user_name'];


    $quantityPattern = "/^[1-9][0-9]*$/";
    $userNamePattern = "/[A-Za-z .]{3,20}/";

    if (!preg_match($quantityPattern, $quantity)) {
        echo "<script> alert('Please enter a valid quantity.')</script>";
        echo "<script> location.href = 'index.php' </script>";
    }

    if (!preg_match($userNamePattern, $userName)) {
        echo "<script> alert('Please enter a valid username.')</script>";
        echo "<script> location.href = 'index.php' </script>";
    }

    // Image handling
    $imagePath = '';

if (isset($_FILES['image'])) {
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageFileName = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $imagePath = 'uploads/' . $imageFileName;

    

    if($imageSize == 0){
        $updateQuery = "UPDATE `laundryms` SET `cloth_type`='$clothType',`quantity`='$quantity'";
    }
    else{

        $updateQuery = "UPDATE `laundryms` SET `cloth_type`='$clothType',`quantity`='$quantity',`image`='$imagePath'";
    }

    mysqli_query($conn, $updateQuery);
    move_uploaded_file($imageTmpName, $imagePath);
}
header("Location: index.php");
    exit();
}
  
else {
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM laundryms WHERE id = '$id'");
    $row = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Laundry</title>
</head>
<style>
    form {
        background: #fff;
        padding: 15px;
        box-shadow: 0px 0px 10px 0px;
        border-radius: 10px;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-6 col-sm-12">

                <form action="" method="POST" enctype="multipart/form-data">
                    <h2 class="mb-3">Edit Laundry</h2>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="mb-3">
                        <label for="cloth_type">Cloth Type:</label>
                        <input type="text" class="form-control" name="cloth_type" value="<?php echo $row['cloth_type']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_name">Customer Name:</label>
                        <input type="text" class="form-control" name="user_name" value="<?php echo $row['user_name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="imagePreview">Image Preview:</label>
                        <img src="<?php echo $row['image']; ?>" id="imagePreview" width="100px">
                    </div>

                    <input type="hidden" name="previous_image" value="<?php echo $row['image']; ?>">

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        image.onchange = evt => {
            var file = image.files[0];
            if(file) {
                imagePreview.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>