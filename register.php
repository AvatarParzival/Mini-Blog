<?php
require_once __DIR__ . '/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if ($name === '' || $email === '' || strlen($pass) < 6) {
        $_SESSION['flash']['danger'] = 'All fields required, password ≥ 6 chars.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['flash']['danger'] = 'Email already registered.';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)")
                ->execute([$name, $email, $hash]);
            $_SESSION['flash']['success'] = 'Account created. Please login.';
            header('Location: /login.php'); exit;
        }
    }
}
?>
<h2>Register</h2>
<form method="post">
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required minlength="6">
  </div>
  <button class="btn btn-primary">Register</button>
</form>
<?php require_once __DIR__ . '/partials/footer.php'; ?>