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

$judul = "Omah Angkringan";
