<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('../phpmailer/Exception.php');
include('../phpmailer/PHPMailer.php');
include('../phpmailer/SMTP.php');
?>
<?php
date_default_timezone_set('Asia/Jakarta');
$conn = mysqli_connect("localhost:8111", "root", "", "angkringan_omah");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
};

function cek_username($username)
{
    global $conn;
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

$judul = "Omah Angkringan";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika username ditemukan dalam database
        $row = mysqli_fetch_assoc($result);
        $email = $row['email']; // Ambil data email dari hasil query

        // Kirim email untuk ganti password
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'imartiraha03@gmail.com';
        $mail->Password = 'yycqdzzqesydemrt';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('imartiraha03@gmail.com', 'Omah Angkringan');
        $mail->addAddress($email);
        $mail->addReplyTo('no-reply@gmail.com', 'Np-reply');
        $mail->isHTML(true);
        $mail->Subject = 'Ganti Password Akun Omah Angkringan - ' . $email;
        $mail->Body    = 'Silahkan klik link ini untuk mengganti password baru akun anda<br><br><a href="http://localhost/angkringan_omah/admin/new_password.php?username=' . $username . '" target="_blank" style="background-color: #1ba4e3;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;">Ganti Password</a>';
        $mail->AltBody = '';
        if (!$mail->send()) {
            echo 'Gagal';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        // 
        echo "<script>alert('Link ganti password berhasil dikirim silahkan cek email anda untuk mengganti password');</script>";
        echo "<script>location='login.php';</script>";

        exit; //agar kode berhenti disini
    } else {
        // Jika username tidak ada dalam database, tampilkan pesan kesalahan:
        echo "<script>alert('Username tidak ditemukan dalam database. Silakan masukkan username valid.')</script>";
        header("Location: forgot_password.php");
        exit;
    }
}
?>
