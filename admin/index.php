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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="box">
                            <div class="title">50</div>
                            <div class="text">Pengunjung</div>
                            <img src="../gambar_produk/Group41.png" alt="">
                        </div>
                        <div class="box">
                            <div class="title">120</div>
                            <div class="text">Order</div>
                            <img src="../gambar_produk/Group43.png" alt="">
                        </div>
                        <div class="box">
                            <div class="title">Rp 500.000</div>
                            <div class="text">Pendapatan</div>
                            <img src="../gambar_produk/Group 45.png" alt="">
                        </div>
                    </div>
                    <div class="background-img">
                        <div class="menu">Ceker Solehot</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="box-text center">
                                <br>
                                <div class="title">Selamat Datang !</div>
                                <div class="text">Selamat datang di website sistem kasir Kafe Omah Angkringan. Website ini akan membantu kamu melakukan transaksi dan pengelolaan administrasi kafe dengan mudah. Ayo buat pesananmu sekarang disini !</div>
                                <img src="../gambar_produk/Group 47.png" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="box-text">
                                <div class="title">Jumlah porsi terjual</div>
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                <script src="graph.js"></script>
                            </div>
                        </div>
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
</body>

</html>