<?php
session_start();

require "../functions.php";

if (isset($_POST['id_pesanan']) && isset($_POST['action'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $action = $_POST['action'];

    $stmt = $conn->prepare("SELECT jumlah FROM pesanan WHERE id = ?");
    $stmt->bind_param("i", $id_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $current_quantity = $row['jumlah'];

    $new_quantity = $action == 'increase' ? $current_quantity + 1 : $current_quantity - 1;
    $new_quantity = max($new_quantity, 0);

    $stmt = $conn->prepare("UPDATE pesanan SET jumlah = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_quantity, $id_pesanan);
    $stmt->execute();
}

$conn->close();
