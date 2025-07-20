<?php
session_start(); 
include_once 'assets/Akses.php'; // koneksi database

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = $pdo->prepare('SELECT * FROM login WHERE username = :username AND password = :password');
    $query->bindValue(':username', $username);
    $query->bindValue(':password', $password); // NB: idealnya password di-hash
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $loginError = 'Email atau password salah.';
    } else {
        $_SESSION["login"] = true;
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Beautypoof</title>
  <link rel="stylesheet" href="assets/login.css">
</head>
<body>

<div class="wrapper">

  <?php 
  include_once 'partials/header.php';
  include_once 'partials/sidebar.php';
  ?>

  <div class="login-container">
    <h1>Form Login</h1>

    <?php if ($loginError): ?>
      <div class="error-message">
        <?= htmlspecialchars($loginError) ?>
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="mb-3">
        <label>Alamat Email</label>
        <input type="email" class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</div>

<?php include_once 'partials/footer.php'; ?>
</body>
</html>
