<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'config.php';

$pesan = '';

// Tambah produk
if (isset($_POST['tambah'])) {
    $nama = $conn_admin->real_escape_string($_POST['nama']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $diskon = (int)$_POST['diskon'];

    $gambar = '';
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $nama_gambar = time() . '_' . uniqid() . '.' . $ext;

    // Ganti ini ke folder yang kamu mau, contoh: 'gambar/', './', atau folder lain
    $folder_tujuan = './'; // ini artinya file disimpan di direktori saat ini (selevel file PHP)

    $target = $folder_tujuan . $nama_gambar;

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $gambar = $nama_gambar; // atau simpan dengan path lengkap kalau mau
    } else {
        die("❌ Gagal upload gambar ke folder: $folder_tujuan");
    }
}


    $query = "INSERT INTO kelola (nama, harga, stok, diskon, gambar, terjual) 
              VALUES ('$nama', $harga, $stok, $diskon, '$gambar', 0)";
    $conn_admin->query($query);
    $conn_penjualan->query($query);

    $pesan = "Produk berhasil ditambahkan.";
}

// Edit produk
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $nama = $conn_admin->real_escape_string($_POST['nama']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $diskon = (int)$_POST['diskon'];

    $conn_admin->query("UPDATE kelola SET nama='$nama', harga=$harga, stok=$stok, diskon=$diskon WHERE id=$id");
    $conn_penjualan->query("UPDATE kelola SET nama='$nama', harga=$harga, stok=$stok, diskon=$diskon WHERE id=$id");

    $pesan = "Produk berhasil diubah.";
}

// Hapus produk
if (isset($_POST['hapus'])) {
    $id = (int)$_POST['id'];
    $conn_admin->query("DELETE FROM kelola WHERE id=$id");
    $conn_penjualan->query("DELETE FROM kelola WHERE id=$id");

    $pesan = "Produk berhasil dihapus.";
}

// Ambil data produk
$produk = $conn_admin->query("SELECT * FROM kelola");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Produk</title>
  <link rel="stylesheet" href="kelola.css">
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    .alert { padding: 10px; background: #def; margin-bottom: 15px; border: 1px solid #aaa; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
    img { max-width: 80px; height: auto; }
    .form-input input, .form-input button {
      padding: 10px; margin: 5px 0; display: block; width: 100%;
    }
    .form-input { max-width: 400px; margin-bottom: 20px; }
  </style>
</head>
<body>

<?php if ($pesan): ?>
  <div class="alert"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<h1>Kelola Produk</h1>

<form method="POST" class="form-input" enctype="multipart/form-data">
  <input name="nama" placeholder="Nama Produk" required>
  <input name="harga" type="number" placeholder="Harga" required>
  <input name="stok" type="number" placeholder="Stok" required>
  <input name="diskon" type="number" placeholder="Diskon" value="0">
  <input type="file" name="gambar" accept="image/*" required>
  <button type="submit" name="tambah">Tambah</button>
</form>

<table>
  <tr>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Diskon</th>
    <th>Terjual</th>
    <th>Aksi</th>
  </tr>
  <?php while ($row = $produk->fetch_assoc()): ?>
    <tr>
      <form method="POST">
        <td>
          <?php if (!empty($row['gambar'])): ?>
            <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="gambar">
          <?php else: ?>
            <em>Tidak ada gambar</em>
          <?php endif; ?>
        </td>
        <td><input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required></td>
        <td><input type="number" name="harga" value="<?= $row['harga'] ?>" required></td>
        <td><input type="number" name="stok" value="<?= $row['stok'] ?>" required></td>
        <td><input type="number" name="diskon" value="<?= $row['diskon'] ?>"></td>
        <td><?= $row['terjual'] ?></td>
        <td>
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" name="edit">Edit</button>
          <button type="reset">Batal</button>
          <button type="submit" name="hapus" onclick="return confirm('Hapus produk ini?')">Hapus</button>
        </td>
      </form>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
