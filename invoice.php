<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    // Fetch the laundry record from the database
    $result = mysqli_query($conn, "SELECT * FROM laundryms WHERE id = '$id'");
    if ($row = mysqli_fetch_array($result)) {
        $clothType = $row['cloth_type'];
        $quantity = $row['quantity'];
        $userName = $row['user_name'];

        
        $pricePerClothType = [
            'Shirt' => 10,
            'Pants' => 15,
            'Dress' => 20,
            
        ];

        // Calculate the total amount
        $totalAmount = $pricePerClothType[$clothType] * $quantity;
    } else {
        
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect the user if the ID is not provided
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        .invoice-container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-label {
            font-weight: bold;
        }

        .invoice-amount {
            font-weight: bold;
            font-size: 18px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2 class="invoice-title">Invoice</h2>
        </div>
        <div class="invoice-details">
            <p><span class="invoice-label">Order Date:</span> <?php echo $row['created_at']; ?></p>
            <p><span class="invoice-label">Customer Name:</span> <?php echo $userName; ?></p>
            <p><span class="invoice-label">Cloth Type:</span> <?php echo $clothType; ?></p>
            <p><span class="invoice-label">Quantity:</span> <?php echo $quantity; ?></p>
            <p><span class="invoice-label">Total Amount:</span> <span class="invoice-amount">৳<?php echo $totalAmount; ?></span></p>
        </div>
        <div class="button-container">
            <a href="index.php" class="btn btn-primary">Back to Index</a>
            <a href="#" class="btn btn-primary" onclick="window.print()">Print</a>
        </div>
    </div>
</body>

</html>

