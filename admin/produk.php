<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $file = $_FILES['gambar'];

    $imagePath = '../gambar_produk/' . uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

    if (move_uploaded_file($file['tmp_name'], $imagePath)) {
        $query = "INSERT INTO produk (nama, harga, kategori, stok, gambar) VALUES ('$nama', '$harga', '$kategori', '$stok','$imagePath')";
        if (mysqli_query($conn, $query)) {
            $script = "
                Swal.fire({
                    icon: 'success',
                    title: 'Produk Berhasil Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        } else {
            $script = "
                Swal.fire({
                    icon: 'error',
                    title: 'Produk Gagal Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        }
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Upload Gambar Gagal!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['edit'])) {
    $id_produk = mysqli_real_escape_string($conn, $_POST['id_produk']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $file = $_FILES['gambar'];

    if ($file['tmp_name']) {
        $imagePath = '../gambar_produk/' . uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        move_uploaded_file($file['tmp_name'], $imagePath);
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga',stok='$stok', kategori = '$kategori', gambar = '$imagePath' WHERE id = '$id_produk'";
    } else {
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga',stok='$stok', kategori = '$kategori' WHERE id = '$id_produk'";
    }

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Produk Berhasil di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Produk Gagal Di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['hapus'])) {
    $id_produk = mysqli_real_escape_string($conn, $_POST['id_produk']);

    $query = "DELETE FROM produk WHERE id = '$id_produk'";
    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Produk Berhasil Dihapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Produk Gagal Di-Hapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            );
        ";
    }
}
?>



<body id="page-top">

    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include "topbar.php"; ?>

                <div class="container-fluid">
                    <div class="mb-3">
                        <p>
                            <a class="btn bg-black text-yellow" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-plus-square"></i> Tambah Menu
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama">Nama Menu:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga:</label>
                                        <input type="number" class="form-control" id="harga" name="harga" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori:</label>
                                        <select class="form-control" id="kategori" name="kategori" required>
                                            <option value="makanan">Makanan</option>
                                            <option value="minuman">Minuman</option>
                                            <option value="jajanan">Jajanan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Stok:</label>
                                        <input type="number" class="form-control" id="harga" name="stok" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Gambar Menu:</label>
                                        <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn bg-black text-yellow w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-yellow">Daftar Menu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM produk");
                                        $stmt->execute();
                                        $produk = $stmt->get_result();
                                        ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($produk as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><img src="../gambar_produk/<?= htmlspecialchars($data['gambar']); ?>" width="100"></td>
                                                <td><?= htmlspecialchars($data['nama']); ?></td>
                                                <td>Rp<?= number_format(htmlspecialchars($data['harga']), 0, ',', '.'); ?></td>
                                                <td><?= htmlspecialchars($data['kategori']); ?></td>
                                                <td><?= htmlspecialchars($data['stok']); ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm bg-black text-yellow" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $data['id'] ?>">Hapus</a>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_produk" value="<?= $data['id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Menu:</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="harga">Harga:</label>
                                                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kategori">Kategori:</label>
                                                                    <select class="form-control" id="kategori" name="kategori" required>
                                                                        <option value="makanan" <?= $data['kategori'] == 'makanan' ? 'selected' : ''; ?>>Makanan</option>
                                                                        <option value="minuman" <?= $data['kategori'] == 'minuman' ? 'selected' : ''; ?>>Minuman</option>
                                                                        <option value="jajanan" <?= $data['kategori'] == 'jajanan' ? 'selected' : ''; ?>>Jajanan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stok">Stok:</label>
                                                                    <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($data['stok']); ?>" required>
                                                                </div>
                                                                <button type="submit" name="edit" class="btn bg-black text-yellow w-100">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="hapusModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus produk: <b><?= htmlspecialchars($data['nama']) ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_produk" value="<?= $data['id'] ?>">
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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