<?php
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once("../functions.php"); // Asumsikan koneksi database Anda ada di sini

// Membuat objek PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nama Toko');
$pdf->SetTitle('Data Penjualan');
$pdf->SetSubject('Laporan Penjualan');

// Menambahkan halaman
$pdf->AddPage();

// Menambahkan isi
$html = '<h1>Data Penjualan</h1>';
$html .= '<table border="1" cellspacing="1" cellpadding="4">
            <tr>
                <th width="10%">#</th>
                <th width="25%">Nama</th>
                <th width="20%">Harga</th>
                <th width="10%">Jumlah</th>
                <th width="15%">Kategori</th>
                <th width="20%">Terjual Pada</th>
            </tr>';

$sql = "SELECT pesanan.id, pesanan.tanggal_pesanan, pesanan.jumlah, produk.nama, produk.harga, produk.kategori 
        FROM pesanan 
        JOIN produk ON pesanan.id_produk = produk.id 
        WHERE pesanan.status = 'Pesanan Selesai'";
$result = $conn->query($sql);

$i = 1;
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $i . '</td>
                <td>' . htmlspecialchars($row['nama']) . '</td>
                <td>Rp' . number_format($row['harga'], 0, ',', '.') . '</td>
                <td>' . htmlspecialchars($row['jumlah']) . '</td>
                <td>' . htmlspecialchars($row['kategori']) . '</td>
                <td>' . htmlspecialchars($row['tanggal_pesanan']) . '</td>
              </tr>';
    $i++;
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Tutup dan output PDF
$pdf->Output('data_penjualan.pdf', 'I');
