<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MyShop | Toko Online</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/a2e0c6fa3e.js" crossorigin="anonymous"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f6f8fa;
      color: #333;
    }

    .container {
      width: 90%;
      max-width: 1100px;
      margin: 0 auto;
    }

    header {
      background-color: #ff5722;
      padding: 15px 0;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #fff;
    }

    .search-bar {
      flex: 1;
      margin: 0 20px;
      padding: 8px 12px;
      border-radius: 8px;
      border: none;
      font-size: 14px;
    }

    .cart-icon {
      color: #fff;
      font-size: 20px;
      position: relative;
    }

    #cart-count {
      background-color: #fff;
      color: #ff5722;
      font-weight: bold;
      padding: 2px 6px;
      border-radius: 50%;
      position: absolute;
      top: -10px;
      right: -10px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 25px;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .card-img {
      width: 100%;
      height: 200px;
      overflow: hidden;
      background-color: #eee;
    }

    .card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .card-body {
      padding: 15px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card h3 {
      font-size: 16px;
      margin-bottom: 5px;
    }

    .card p {
      color: #666;
      margin-bottom: 10px;
    }

    .card button {
      padding: 8px 12px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .card button:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    table th, table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    select {
      margin-top: 10px;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      width: 100%;
    }

    .checkout-btn {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      background-color: #ff5722;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .checkout-btn:hover {
      background-color: #e64a19;
    }

    h2 {
      margin-top: 30px;
      margin-bottom: 15px;
      color: #333;
    }
  </style>
</head>
<body>

<header>
  <div class="container nav">
    <div class="logo">🛍️ Arelshop</div>
    <input type="text" placeholder="Cari produk..." class="search-bar">
    <div class="cart-icon">
      <i class="fas fa-shopping-cart"></i>
      <span id="cart-count">0</span>
    </div>
  </div>
</header>

<main class="container">
  <h2>Produk Terlaris</h2>
  <div class="product-grid">
    <?php
    $result = $conn_penjualan->query("SELECT * FROM kelola WHERE stok > 0");
    while ($p = $result->fetch_assoc()):
      $harga_diskon = $p['harga'] - ($p['harga'] * $p['diskon'] / 100);
    ?>
      <div class="card">
        <div class="card-img">
          <?php if (!empty($p['gambar']) && file_exists($p['gambar'])): ?>
            <img src="<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['nama']) ?>">
          <?php else: ?>
            <img src="placeholder.jpg" alt="No image">
          <?php endif; ?>
        </div>
        <div class="card-body">
          <h3><?= htmlspecialchars($p['nama']) ?></h3>
          <p>
            <?php if ($p['diskon'] > 0): ?>
              <del>Rp <?= number_format($p['harga']) ?></del><br>
              <strong>Rp <?= number_format($harga_diskon) ?></strong>
            <?php else: ?>
              Rp <?= number_format($p['harga']) ?>
            <?php endif; ?>
          </p>
          <button onclick="addToCart('<?= htmlspecialchars($p['nama']) ?>', <?= $harga_diskon ?>)">+ Keranjang</button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <h2>🛒 Keranjang Belanja</h2>
  <form action="checkout.php" method="POST" onsubmit="return prepareCheckout()">
    <table id="cart-table">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <label for="metode">Metode Pembayaran:</label>
    <select name="metode_pembayaran" required>
      <option value="" disabled selected>Pilih metode</option>
      <option value="Tunai">Tunai</option>
      <option value="Transfer Bank">Transfer Bank</option>
      <option value="E-Wallet">E-Wallet</option>
    </select>

    <input type="hidden" name="checkout_data" id="checkout-data">
    <button type="submit" class="checkout-btn">Bayar Sekarang</button>
  </form>
</main>

<script>
  const cart = [];
  const tableBody = document.querySelector("#cart-table tbody");
  const cartCount = document.getElementById("cart-count");

  function addToCart(nama, harga) {
    const found = cart.find(item => item.nama === nama);
    if (found) {
      found.jumlah += 1;
    } else {
      cart.push({ nama, harga, jumlah: 1 });
    }
    renderCart();
  }

  function renderCart() {
    tableBody.innerHTML = "";
    let total = 0;
    cart.forEach((item, index) => {
      const itemTotal = item.harga * item.jumlah;
      tableBody.innerHTML += `
        <tr>
          <td>${item.nama}</td>
          <td>
            <button type="button" onclick="changeQty(${index}, -1)">−</button>
            ${item.jumlah}
            <button type="button" onclick="changeQty(${index}, 1)">+</button>
          </td>
          <td>Rp ${item.harga.toLocaleString()}</td>
          <td>Rp ${itemTotal.toLocaleString()}</td>
        </tr>`;
      total += item.jumlah;
    });
    cartCount.textContent = total;
  }

  function changeQty(index, change) {
    cart[index].jumlah += change;
    if (cart[index].jumlah <= 0) {
      cart.splice(index, 1);
    }
    renderCart();
  }

  function prepareCheckout() {
    document.getElementById("checkout-data").value = JSON.stringify(cart);
    return cart.length > 0;
  }
</script>

</body>
</html>
