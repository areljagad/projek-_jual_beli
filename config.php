<?php
$host = "localhost";
$user = "root"; // sesuaikan dengan username MySQL kamu
$pass = "";     // sesuaikan dengan password MySQL kamu

// Koneksi ke database admin
$db_admin = "admin_db"; // ubah nama database admin sesuai dengan milikmu
$conn_admin = new mysqli($host, $user, $pass, $db_admin);
if ($conn_admin->connect_error) {
    die("Koneksi ke database admin gagal: " . $conn_admin->connect_error);
}

// Koneksi ke database penjualan
$db_penjualan = "penjualan_db";
$conn_penjualan = new mysqli($host, $user, $pass, $db_penjualan);
if ($conn_penjualan->connect_error) {
    die("Koneksi ke database penjualan gagal: " . $conn_penjualan->connect_error);
}
?>
