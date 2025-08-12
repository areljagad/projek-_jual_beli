<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Admin</title>
  <link rel="stylesheet" href="admin.css"> <!-- Optional: CSS khusus admin -->
</head>
<body>
  <div class="admin-container">
    <h1>👩‍💼 Selamat Datang, Admin!</h1>
    <p>Gunakan menu di bawah untuk mengelola sistem:</p>

    <ul>
      <li><a href="dashboard.php">📊 Lihat Dashboard Penjualan</a></li>
      <li><a href="kelola-produk.php">📦 Kelola Produk</a></li>
      <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
  </div>
</body>
</html>
