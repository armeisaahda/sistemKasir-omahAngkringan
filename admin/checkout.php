<?php
require "../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'complete_order') {
    $sql = "UPDATE pesanan SET status = 'Pesanan Selesai' WHERE status = 'Dalam Keranjang'";
    if ($conn->query($sql) === TRUE) {
        echo "Pesanan telah berhasil diproses.";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
