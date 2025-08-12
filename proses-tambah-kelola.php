<?php
include 'config.php';

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$diskon = $_POST['diskon'] ?? 0;

// Simpan ke database admin
$conn_admin->query("INSERT INTO kelola (nama, harga, stok, diskon, terjual) VALUES ('$nama', '$harga', '$stok', '$diskon', 0)");

// Simpan ke database penjualan
$conn_penjualan->query("INSERT INTO kelola (nama, harga, stok, diskon, terjual) VALUES ('$nama', '$harga', '$stok', '$diskon', 0)");

header("Location: kelola-produk.php");
