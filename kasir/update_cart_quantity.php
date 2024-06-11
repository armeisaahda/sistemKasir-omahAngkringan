<?php
session_start();

require "../functions.php";

if (isset($_POST['id_pesanan']) && isset($_POST['jumlah'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare("UPDATE pesanan SET jumlah = ? WHERE id = ?");
    $stmt->bind_param("ii", $jumlah, $id_pesanan);

    if ($stmt->execute()) {
        echo "Kuantitas diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
