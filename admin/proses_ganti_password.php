<?php
// Lakukan koneksi ke database
$conn = mysqli_connect("localhost:3307", "root", "", "angkringan_omah");

// Fungsi untuk memvalidasi password baru
function validatePassword($password, $confirm_password)
{
    // Contoh validasi sederhana: pastikan password dan konfirmasi password sama
    if ($password !== $confirm_password) {
        return "Password dan konfirmasi password tidak cocok.";
    }
    return ""; // Password valid
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password baru
    $validationMessage = validatePassword($password, $confirm_password);
    if ($validationMessage !== "") {
        // Redirect kembali ke halaman ganti password dengan pesan kesalahan
        echo "<script>alert('$validationMessage');</script>";
        echo "<script>location='new_password.php?username=$username&error=$validationMessage';</script>";

        // header("Location: new_password.php?username=$username&error=$validationMessage");
        exit;
    }

    // Query untuk update password baru ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Menggunakan hash password
    $query = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";

    if (mysqli_query($conn, $query)) {
        // Password berhasil diubah, redirect ke halaman login atau halaman lain yang sesuai
        echo "<script>alert('Berhasil mengubah password baru!');</script>";

        echo "<script>location='login.php?password_changed=true';</script>";
        // header("Location: login.php?password_changed=true");
        exit;
    } else {
        // Jika terjadi kesalahan saat mengubah password
        echo "Error: " . mysqli_error($conn);
    }
}

// Jika tidak ada data yang dikirimkan melalui POST, alihkan kembali ke halaman ganti password
header("Location: ganti_password.php");
exit;
