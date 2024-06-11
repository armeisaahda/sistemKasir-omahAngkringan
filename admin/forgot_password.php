<?php

session_start();
include '../functions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_user = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    if (mysqli_num_rows($check_user) > 0) {
        $script = "
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Username atau Email sudah digunakan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true
            });
        ";
    } else {
        $insert = "INSERT INTO admin (username, password, role) 
                   VALUES ('$username', '$hashed_password', '$role')";
        if (mysqli_query($conn, $insert)) {
            $script = "
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pendaftaran berhasil!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true
                });
                setTimeout(function() {
                    window.location.href = 'login.php'; 
                }, 3000);
            ";
        } else {
            $script = "
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Pendaftaran gagal!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true
                });
            ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $judul; ?> </title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.5rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating label {
            color: #000;
        }

        .form-floating .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 40px;
        }

        .btn {

            border-radius: 40px;
        }

        .link-primary {
            color: #007bff;
        }

        .link-primary:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <section class="content">
        <div class="row">
            <div class="col-md-4 image-container">
                <img src="../img/bg2.png" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-md-12 form-container py-3 py-md-5 mt-5">
                        <form action="cek_username.php" method="post" enctype="multipart/form-data">
                            <div class="text-center mb-4">
                                <h1 style="color:black;" class="my-3">FORGOT PASSWORD</h1>
                                <span>Tuliskan email kamu agar kami bisa mengirimkan kode <br> konfirmasi email</span>
                            </div>
                            <div class="row gy-2 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <label for="username" class="form-label" style="color: black;">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder=" Username" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid my-3">
                                        <button class="btn bg-black text-yellow btn-sm w-100" type="submit" name="register">Konfirmasi Email</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>
    <?php include "plugin.php"; ?>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>

</body>

</html>