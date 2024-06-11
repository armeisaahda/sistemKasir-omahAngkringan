<?php
session_start();

require "../functions.php";

if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
    $id_produk = $_POST['id_produk'];
    $id_admin = $_SESSION['id_admin'];
    $jumlah = 1;

    $stmt = $conn->prepare("INSERT INTO pesanan (id_produk, id_admin, jumlah, status) VALUES (?, ?, ?, 'Dalam Keranjang')");
    $stmt->bind_param("iii", $id_produk, $id_admin, $jumlah);

    if ($stmt->execute()) {
        echo "Item berhasil ditambahkan ke keranjang.";
        include('cartItems.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
