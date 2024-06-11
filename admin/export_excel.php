<?php
require '../vendor/autoload.php';
require '../functions.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header
$sheet->setCellValue('A1', '#');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Harga');
$sheet->setCellValue('D1', 'Jumlah');
$sheet->setCellValue('E1', 'Kategori');
$sheet->setCellValue('F1', 'Terjual Pada');

// Data
$sql = "SELECT pesanan.id, pesanan.tanggal_pesanan, pesanan.jumlah, produk.nama, produk.harga, produk.kategori 
        FROM pesanan 
        JOIN produk ON pesanan.id_produk = produk.id 
        WHERE pesanan.status = 'Pesanan Selesai'";
$result = $conn->query($sql);
$rowCount = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
    $sheet->setCellValue('B' . $rowCount, $row['nama']);
    $sheet->setCellValue('C' . $rowCount, 'Rp' . number_format($row['harga'], 0, ',', '.'));
    $sheet->setCellValue('D' . $rowCount, $row['jumlah']);
    $sheet->setCellValue('E' . $rowCount, $row['kategori']);
    $sheet->setCellValue('F' . $rowCount, $row['tanggal_pesanan']);
    $rowCount++;
}

// Menulis file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('data_penjualan.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data_penjualan.xlsx"');
$writer->save('php://output');
