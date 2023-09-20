<?php
include 'config.php';

$id = $_GET['id'];
$img = $_GET['img'];

mysqli_query($conn, "DELETE FROM laundryms WHERE id = $id");
unlink($img);

header("Location: index.php");
?>

