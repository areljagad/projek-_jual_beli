<?php
session_start();
include 'config.php';

// Cek login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Ambil data produk dan transaksi
$produk = $conn_admin->query("SELECT * FROM kelola");
$transaksi = $conn_penjualan->query("SELECT * FROM transaksi ORDER BY id DESC");

// Hitung statistik
$total_produk = $conn_admin->query("SELECT COUNT(*) as total FROM kelola")->fetch_assoc()['total'];
$total_terjual = $conn_admin->query("SELECT SUM(terjual) as terjual FROM kelola")->fetch_assoc()['terjual'];
$total_stok = $conn_admin->query("SELECT SUM(stok) as stok FROM kelola")->fetch_assoc()['stok'];

$chart_labels = [];
$chart_data = [];

$produk_chart = $conn_admin->query("SELECT nama, terjual FROM kelola ORDER BY terjual DESC LIMIT 5");
while($pc = $produk_chart->fetch_assoc()) {
    $chart_labels[] = $pc['nama'];
    $chart_data[] = $pc['terjual'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
  <h1>Dashboard Admin</h1>
  <p>Total Produk: <?= $total_produk ?></p>
  <p>Total Stok: <?= $total_stok ?></p>
  <p>Total Terjual: <?= $total_terjual ?></p>
  <h2>Diagram Produk Terlaris</h2>
<canvas id="produkChart" width="600" height="300"></canvas>


  <h2>Kelola Produk</h2>
  <table border="1" cellpadding="8">
    <tr>
      <th>Nama</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Diskon</th>
      <th>Terjual</th>
    </tr>
    <?php while($row = $produk->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td>Rp <?= number_format($row['harga']) ?></td>
        <td><?= $row['stok'] ?></td>
        <td><?= $row['diskon'] ?>%</td>
        <td><?= $row['terjual'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h2>Riwayat Transaksi</h2>
  <table border="1" cellpadding="8">
    <tr>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Harga</th>
      <th>Total</th>
      <th>Metode</th>
      <th>Tanggal</th>
    </tr>
    <?php while($t = $transaksi->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($t['nama_barang']) ?></td>
        <td><?= $t['jumlah'] ?></td>
        <td>Rp <?= number_format($t['harga']) ?></td>
        <td>Rp <?= number_format($t['total']) ?></td>
        <td><?= htmlspecialchars($t['metode_pembayaran']) ?></td>
        <td><?= $t['created_at'] ?? '-' ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
<script>
  const ctx = document.getElementById('produkChart').getContext('2d');
  const produkChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($chart_labels) ?>,
      datasets: [{
        label: 'Produk Terjual',
        data: <?= json_encode($chart_data) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });
</script>

</html>
