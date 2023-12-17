<?php
session_start();
include '../components/connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $updatedQuantity = $_POST['quantity'];

    // Update the session variable
    $_SESSION['updated_quantity'][$productId] = $updatedQuantity;

    // Update the database
    $updateQuantity = $conn->prepare("UPDATE `products` SET `quantity` = ? WHERE `id` = ?");
    $updateQuantity->execute([$updatedQuantity, $productId]);

    if ($updateQuantity) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
