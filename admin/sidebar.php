<ul class="navbar-nav bg-black text-yellow sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black !important;">
    <style>
        .nav-item.active .nav-link {
            background-color: #B6952C;
        }

        .hidden img {
            display: none;
        }
    </style>
    <?php
    $halaman = basename($_SERVER['PHP_SELF']);
    ?>
    <a class="sidebar-brand text-white d-flex align-items-center justify-content-center" href="index.php" style="font-size: 9pt;" id="brandLink">
        <img src="../img/garpu.png" width="15px">&nbsp; Omah Angkringan
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item <?php if ($halaman == 'index.php') echo 'active'; ?>">
        <a class="nav-link text-white" href="index.php">
            <img src="../img/home.png" width="15px">&nbsp;
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item <?php if ($halaman == 'kasir.php') echo 'active'; ?>">
        <a class="nav-link text-white" href="kasir.php">
            <img src="../img/kasir.png" width="15px">&nbsp;
            <span>Kasir</span></a>
    </li>

    <li class="nav-item <?php if ($halaman == 'produk.php') echo 'active'; ?>">
        <a class="nav-link text-white" href="produk.php">
            <img src="../img/menu.png" width="15px">&nbsp;
            <span>Daftar Menu</span></a>
    </li>


    <li class="nav-item <?php if ($halaman == 'user.php') echo 'active'; ?>">
        <a class="nav-link text-white" href="user.php">
            <img src="../img/user.png" width="15px">&nbsp;
            <span>User</span></a>
    </li>


    <li class="nav-item <?php if ($halaman == 'laporan.php') echo 'active'; ?>">
        <a class="nav-link text-white" href="laporan.php">
            <img src="../img/laporan.png" width="15px">&nbsp;
            <span>Laporan Penjualan</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        var brandLink = document.getElementById('brandLink');
        brandLink.classList.toggle('hidden');
    });
</script>