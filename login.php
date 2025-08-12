<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === "Hawa" && $password === "Hawa0053") {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
} 
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: linear-gradient(270deg, #00c6ff, #0072ff, #6a00ff, #ff00cc);
    background-size: 800% 800%;
    animation: gradientMove 15s ease infinite;
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 2000px;
    overflow: hidden;
    position: relative;
  }
  @keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  /* Partikel */
  .bokeh {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 0;
  }
  .bokeh span {
    position: absolute;
    display: block;
    background: rgba(255,255,255,0.3);
    border-radius: 50%;
    animation: float 10s linear infinite;
  }
  @keyframes float {
    0% { transform: translateY(100vh) scale(0.5); opacity: 0.3; }
    50% { opacity: 0.8; }
    100% { transform: translateY(-20vh) scale(1); opacity: 0; }
  }

  /* Login wrapper */
  .login-wrapper {
    perspective: 1600px;
    width: 400px;
    height: auto;
    position: relative;
  }

  /* Login container efek pintu */
  .login-container {
    position: relative;
    transform-style: preserve-3d;
    transform-origin: left center;
    transform: rotateY(-90deg);
    transition: transform 0.9s cubic-bezier(0.77, 0, 0.175, 1);
    background: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    width: 100%;
    text-align: center;
    z-index: 1;
  }
  .login-container.open {
    transform: rotateY(0deg);
  }

  /* Border glow */
  .login-container::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    border-radius: 15px;
    background: linear-gradient(90deg, #ff00cc, #3333ff, #00ffcc, #ffcc00, #ff00cc);
    background-size: 400% 400%;
    animation: borderGlow 6s linear infinite;
    z-index: -1;
  }
  .login-container::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    right: 2px;
    bottom: 2px;
    background: white;
    border-radius: 10px;
    z-index: -1;
  }
  @keyframes borderGlow {
    0% { background-position: 0 0; }
    100% { background-position: 400% 0; }
  }

  /* Form styling */
  h2 { margin-bottom: 20px; color: #333; }
  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
  }
  input:focus {
    border-color: #0072ff;
    box-shadow: 0 0 10px rgba(0, 114, 255, 0.5);
  }
  button {
    width: 100%;
    padding: 12px;
    background-color: #0072ff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s, transform 0.2s;
  }
  button:hover {
    background-color: #005fc1;
    transform: scale(1.05);
  }
  p.error {
    margin-top: 10px;
    color: red;
    font-weight: bold;
  }
</style>
</head>
<body>

<!-- Partikel -->
<div class="bokeh">
  <?php for($i=0; $i<20; $i++): ?>
    <span style="
      left: <?= rand(0, 100) ?>%;
      animation-delay: <?= rand(0, 10) ?>s;
      animation-duration: <?= rand(6, 15) ?>s;
      width: <?= rand(10, 30) ?>px;
      height: <?= rand(10, 30) ?>px;
    "></span>
  <?php endfor; ?>
</div>

<div class="login-wrapper" id="loginWrapper">
  <div class="login-container" id="loginCard">
    <h2>Login Admin</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</div>

<script>
  const loginWrapper = document.getElementById("loginWrapper");
  const loginCard = document.getElementById("loginCard");
  let closeTimeout;

  function openLogin() {
    loginCard.classList.add("open");
    clearTimeout(closeTimeout);
    closeTimeout = setTimeout(() => {
      loginCard.classList.remove("open");
    }, 4000); // Tutup otomatis setelah 4 detik
  }

  loginWrapper.addEventListener("mouseenter", openLogin);
  loginWrapper.addEventListener("click", openLogin); // Untuk layar sentuh
</script>

</body>
</html>
