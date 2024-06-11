<?php

session_start();
include '../functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    // $role = $_POST['role']; // Ambil peran dari form

    // Ubah kueri SQL sesuai dengan peran yang dipilih
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['id_admin'] = $row['id'];

            // Periksa peran pengguna dan arahkan sesuai ke halaman yang sesuai
            if ($_SESSION['role'] == 'admin') {
                $redirect_url = 'index.php'; // Redirect ke index.php jika admin
            } elseif ($_SESSION['role'] == 'kasir') {
                $redirect_url = '../kasir/index.php'; // Redirect ke kasir/index.php jika kasir
            }

            $script = "
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Login Berhasil!',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            toast: true
                        });
                        setTimeout(function() {
                            window.location.href = '$redirect_url'; 
                        }, 3000);
                    ";
        } else {
            $script = "
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password Salah!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true
                });
            ";
        }
    } else {
        $script = "
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Username Tidak Ditemukan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true
            });
        ";
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
        .card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-floating .form-label {
            color: #000;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body style="background-image: url('../img/bg.jpeg');background-size:cover;">


    <section class=" py-3 py-md-5 mt-5">
        <div class="container">
            <br>
            <br>
            <div class="row justify-content-center">

                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">

                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <center>
                                <img src="../img/logo.jpeg" class="rounded-circle" width="100" alt="">
                                <h1 style="color:black;" class="my-3">LOGIN</h1>
                            </center>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="username" class="form-label" style="color: black;">Username</label>
                                            <input type="text" class="form-control rounded-9" name="username" id="username" placeholder="Username" required style="border-radius: 40px;">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="password" class="form-label" style="color: black;">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required style="border-radius: 40px;">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="" style="color: black;">
                                            <input type="checkbox" name="" id=""> Ingat Saya
                                        </div>
                                        <a href="forgot_password.php">
                                            <div class="float-right" style="color: black;">
                                                Lupa Password ?
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn bg-black text-yellow btn-sm w-100" type="submit" name="login">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            Belum memiliki Akun?<a href="register.php" style="margin-left: 5px;">Daftar disini</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include "plugin.php"; ?>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>

</body>

</html>