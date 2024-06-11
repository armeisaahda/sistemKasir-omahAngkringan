<?php

session_start();
include '../functions.php';

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?= $judul; ?></title>
<link rel="icon" href="../img/logo.png" type="image/x-icon">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="../vendor/fontawesome-free/css/fontawesome.css">
<script src="../vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="../vendor/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/index.css">
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@100..900&family=Jacquard+24&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rakkas&display=swap" rel="stylesheet">