<?php
require "../functions.php";  // Pastikan file ini berisi koneksi ke database

$totalHarga = 0;  // Variabel untuk menyimpan total harga

$sql = "SELECT pesanan.id as id, produk.nama, produk.harga, produk.gambar, pesanan.jumlah 
        FROM pesanan 
        JOIN produk ON pesanan.id_produk = produk.id 
        WHERE pesanan.status = 'Dalam Keranjang'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='cart-item'>";
        echo "<img src='../gambar_produk/" . htmlspecialchars($row['gambar']) . "' alt='" . htmlspecialchars($row['nama']) . "'>";
        echo "<div class='cart-item-details'>";
        echo "<p>" . htmlspecialchars($row['nama']) . "</p>";
        echo "<p class='price'>Rp" . number_format($row['harga'], 2, ',', '.') . "</p>";
        echo "</div>";
        echo "<div class='quantity-controls'>";
        echo "<button class='decrease-quantity' data-id='" . $row['id'] . "'>-</button>";
        echo "<input type='text' value='" . $row['jumlah'] . "' class='quantity' readonly>";
        echo "<button class='increase-quantity' data-id='" . $row['id'] . "'>+</button>";
        echo "</div>";
        echo "<button class='remove-from-cart' data-id='" . $row['id'] . "'>Remove</button>";
        echo "</div>";

        // Menghitung total harga
        $totalHarga += $row['harga'] * $row['jumlah'];
    }

    // Menampilkan total harga
    echo "<div class='total'>";
    echo "<p>Total Harga: Rp" . number_format($totalHarga, 2, ',', '.') . "</p>";
    echo "</div>";
} else {
    echo "Keranjang Anda kosong.";
}

$conn->close();
