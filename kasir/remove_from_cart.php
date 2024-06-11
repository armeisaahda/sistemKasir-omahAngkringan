<?php
session_start();

require "../functions.php";

if (isset($_POST['id_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];

    // Pastikan untuk menangani SQL injection
    $stmt = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
    $stmt->bind_param("i", $id_pesanan);

    if ($stmt->execute()) {
        echo "Item dihapus dari keranjang.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
