<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek duplikasi username
    $checkQuery = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Username sudah digunakan!',
                text: 'Mohon pilih username lain.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $query = "INSERT INTO admin (username, password,email, role) VALUES ('$username', '$hashedPassword','$email, '$role')";
        if (mysqli_query($conn, $query)) {
            $script = "
                Swal.fire({
                    icon: 'success',
                    title: 'Admin Berhasil Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        } else {
            $script = "
                Swal.fire({
                    icon: 'error',
                    title: 'Admin Gagal Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        }
    }
}

if (isset($_POST['edit'])) {
    $id_admin = mysqli_real_escape_string($conn, $_POST['id_admin']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE admin SET username = '$username', password = '$hashedPassword',email='$email', role = '$role' WHERE id = '$id_admin'";
    } else {
        $query = "UPDATE admin SET username = '$username',email='$email',  role = '$role' WHERE id = '$id_admin'";
    }

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Admin Berhasil di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Admin Gagal Di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['hapus'])) {
    $id_admin = mysqli_real_escape_string($conn, $_POST['id_admin']);

    $query = "DELETE FROM admin WHERE id = '$id_admin'";
    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Admin Berhasil Dihapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Admin Gagal Di-Hapus!',
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
                                <i class="fas fa-plus-square"></i> Tambah User
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role:</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="kasir">Kasir</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn bg-black text-yellow w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-yellow">Data User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM admin");
                                        $stmt->execute();
                                        $admin = $stmt->get_result();
                                        ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($admin as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= htmlspecialchars($data['username']); ?></td>
                                                <td><?= htmlspecialchars($data['role']); ?></td>
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
                                                            <h5 class="modal-title" id="editModalLabel">Edit Data Admin</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_admin" value="<?= $data['id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="username">Username:</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($data['username']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email:</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password Baru (Opsional):</label>
                                                                    <input type="password" class="form-control" id="password" name="password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="role">Role:</label>
                                                                    <select class="form-control" id="role" name="role" required>
                                                                        <option value="kasir" <?= $data['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
                                                                        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                                    </select>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Admin</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus admin dengan Username: <b><?= htmlspecialchars($data['username']) ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_admin" value="<?= $data['id'] ?>">
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