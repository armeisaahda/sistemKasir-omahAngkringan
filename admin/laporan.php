<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include "topbar.php"; ?>

                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-yellow">Data Penjualan</h6>
                            <hr>

                        </div>
                        <div class="card-body">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group mb-3">
                                            <label for="">Dari tanggal </label>
                                            <input type="date" class="form-control" name="startDate" value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group mb-3">

                                            <label for="">Sampai Tanggal</label>
                                            <input type="date" class="form-control" name="endDate" value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_GET['startDate']) && isset($_GET['endDate'])) {

                                $startDate = $_GET['startDate'];
                                $endDate = $_GET['endDate'];

                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Terjual Pada</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT pesanan.id, DATE_FORMAT(pesanan.tanggal_pesanan, '%Y-%m-%d %H:%i:%s') as tanggal_pesanan, pesanan.jumlah, produk.gambar, produk.nama, produk.harga, produk.kategori 
                                        FROM pesanan 
                                        JOIN produk ON pesanan.id_produk = produk.id 
                                        WHERE DATE(pesanan.tanggal_pesanan) BETWEEN '$startDate' AND '$endDate' 
                                        ORDER BY pesanan.id DESC";
                                            $result = $conn->query($sql);; ?>
                                            <?php if ($result->num_rows > 0) : ?>
                                                <?php $i = 1;
                                                $total = 0; ?>
                                                <?php while ($data = $result->fetch_assoc()) : ?>
                                                    <?php

                                                    $subtotal = $data['jumlah'] * $data['harga'];
                                                    $total = $total + $subtotal; ?>

                                                    <tr>

                                                        <td><?= $i; ?></td>
                                                        <td><?= htmlspecialchars($data['nama']); ?></td>
                                                        <td><?= htmlspecialchars($data['kategori']); ?></td>
                                                        <td><?= htmlspecialchars($data['tanggal_pesanan']); ?></td>
                                                        <td><?= htmlspecialchars($data['jumlah']); ?></td>
                                                        <td>Rp<?= number_format(htmlspecialchars($data['harga']), 0, ',', '.'); ?></td>
                                                        <td>Rp<?= number_format(htmlspecialchars($subtotal), 0, ',', '.'); ?></td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endwhile; ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan="6">Total Penjualan</th>
                                                        <th>Rp<?= number_format(htmlspecialchars($total), 0, ',', '.'); ?></th>
                                                    </tr>
                                                </thead>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5">Tidak ada data penjualan.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }

                            if (!isset($_GET['startDate']) && !isset($_GET['endDate'])) { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Terjual Pada</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT pesanan.id, pesanan.tanggal_pesanan, pesanan.jumlah, produk.gambar, produk.nama, produk.harga, produk.kategori 
                                        FROM pesanan 
                                        JOIN produk ON pesanan.id_produk = produk.id 
                                        WHERE pesanan.status = 'Pesanan Selesai' ORDER BY pesanan.id DESC";
                                            $result = $conn->query($sql);; ?>
                                            <?php if ($result->num_rows > 0) : ?>
                                                <?php $i = 1;
                                                $total = 0; ?>
                                                <?php while ($data = $result->fetch_assoc()) : ?>
                                                    <?php

                                                    $subtotal = $data['jumlah'] * $data['harga'];
                                                    $total = $total + $subtotal; ?>

                                                    <tr>

                                                        <td><?= $i; ?></td>
                                                        <td><?= htmlspecialchars($data['nama']); ?></td>
                                                        <td><?= htmlspecialchars($data['kategori']); ?></td>
                                                        <td><?= htmlspecialchars($data['tanggal_pesanan']); ?></td>
                                                        <td><?= htmlspecialchars($data['jumlah']); ?></td>
                                                        <td>Rp<?= number_format(htmlspecialchars($data['harga']), 0, ',', '.'); ?></td>
                                                        <td>Rp<?= number_format(htmlspecialchars($subtotal), 0, ',', '.'); ?></td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endwhile; ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan="6">Total Penjualan</th>
                                                        <th>Rp<?= number_format(htmlspecialchars($total), 0, ',', '.'); ?></th>
                                                    </tr>
                                                </thead>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5">Tidak ada data penjualan.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="m-1 btn btn-danger" onclick="window.location.href='export_pdf.php'">Ekspor PDF</button>
                        <button class="m-1 btn btn-success" onclick="window.location.href='export_excel.php'">Ekspor Excel</button>
                    </div>

                </div>



            </div>

            <?php include "footer.php"; ?>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "plugin.php"; ?>

    <script>
        $(document).ready(function() {
            $('#dataX').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sLast": "Terakhir",
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    },
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sSearch": "Cari:",
                    "sEmptyTable": "Tidak ada data yang tersedia dalam tabel",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ada data yang cocok dengan pencarian Anda"
                }
            });
        });
    </script>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>
</body>

</html>