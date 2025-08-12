<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $metode = $_POST['metode_pembayaran'];
  $data = json_decode($_POST['checkout_data'], true);

  if (!is_array($data)) {
    echo "<script>alert('❌ Data checkout tidak valid'); window.history.back();</script>";
    exit;
  }

  foreach ($data as $item) {
    $nama = $item['nama'];
    $jumlah = (int)$item['jumlah'];
    $harga = (int)$item['harga'];
    $total = $jumlah * $harga;

    // Cek stok dari database admin (tabel kelola)
    $cek = $conn_admin->prepare("SELECT stok FROM kelola WHERE nama = ?");
    $cek->bind_param("s", $nama);
    $cek->execute();
    $result = $cek->get_result();
    $produk = $result->fetch_assoc();

    if (!$produk || $produk['stok'] < $jumlah) {
      echo "<script>alert('❌ Stok tidak cukup untuk produk: $nama'); window.history.back();</script>";
      exit;
    }

    // Simpan transaksi ke database penjualan (tabel transaksi)
    $stmt = $conn_penjualan->prepare("INSERT INTO transaksi (nama_barang, jumlah, harga, total, metode_pembayaran) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiis", $nama, $jumlah, $harga, $total, $metode);
    $stmt->execute();

    // Update stok dan terjual di admin (tabel kelola)
    $stmt2 = $conn_admin->prepare("UPDATE kelola SET stok = stok - ?, terjual = terjual + ? WHERE nama = ?");
    $stmt2->bind_param("iis", $jumlah, $jumlah, $nama);
    $stmt2->execute();
  }

  echo "<script>alert('✅ Pembayaran berhasil!'); window.location.href = 'index.php';</script>";
}
?>
