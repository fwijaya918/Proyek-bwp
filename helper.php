<?php

session_start();

function alert($message)
{
    echo "<script>alert('$message');</script>";
}
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
$con = mysqli_connect('localhost', 'root', '', 'db_proyek');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
