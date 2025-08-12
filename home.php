<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Kita</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>

  <header class="navbar">
    <div class="logo">Toko <span>Kita</span></div>
    <nav>
      <ul class="nav-links">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#profil">Profil</a></li>
        <li><a href="#menu">Menu</a></li>
        <li><a href="penjualan.php">Keranjang 🛒</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="beranda" class="hero">
      <img src="img/tokobaju.jpg" alt="Banner Toko Kita">
      <h1>Selamat Datang di <strong>Toko Kita</strong></h1>
      <p>Toko terpercaya untuk kebutuhan sehari-hari Anda.</p>
    </section>

    <section id="profil" class="section">
      <h2>Profil Perusahaan</h2>
      <p><strong>Toko Kita</strong> adalah usaha retail yang menyediakan berbagai macam produk kebutuhan harian, mulai dari makanan, minuman, hingga perlengkapan rumah tangga.</p>
      <p>Berdiri sejak 2020, kami berkomitmen untuk memberikan pelayanan terbaik dengan produk berkualitas.</p>
      <p>Visi kami adalah menjadi toko pilihan utama masyarakat Indonesia dalam memenuhi kebutuhan sehari-hari.</p>
    </section>

    <section id="menu" class="section">
      <h2>Menu Produk</h2>
      <p>Silakan kunjungi halaman <a href="kelola-produk.php">produk kami</a> untuk melihat dan membeli barang-barang terbaik pilihan kami.</p>
    </section>

    <section id="lokasi" class="section">
      <h2>Lokasi Kami</h2>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.593264543578!2d106.81666651409573!3d-6.200000995520937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f4df6b7e9f%3A0x401576d14fed840!2sJakarta!5e0!3m2!1sen!2sid!4v1628069810970!5m2!1sen!2sid" 
        width="100%" 
        height="300" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
      </iframe>
    </section>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Toko Kita. Seluruh hak cipta dilindungi.</p>
  </footer>

  <script>
    // Smooth scroll for navigation links
    document.querySelectorAll('.nav-links a[href^="#"]').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          window.scrollTo({
            top: target.offsetTop - 70,
            behavior: 'smooth'
          });
        }
      });
    });

    // Animation on scroll (fade-in)
    const sections = document.querySelectorAll('.section, .hero');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fade-in');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    sections.forEach(section => {
      section.classList.add('hidden');
      observer.observe(section);
    });
  </script>

</body>
</html>
