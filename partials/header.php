<?php
session_start();
require_once __DIR__ . '/../config/db.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-control, .btn {
            border-radius: 6px;
        }
        .post-content {
            line-height: 1.7;
        }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="/miniblog/index.php">
        <i class="bi bi-pencil-square me-2"></i>Mini Blog
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/miniblog/index.php"><i class="bi bi-house-door me-1"></i> Home</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="/miniblog/dashboard.php"><i class="bi bi-journal-text me-1"></i> My Posts</a></li>
          <li class="nav-item"><a class="nav-link" href="/miniblog/create.php"><i class="bi bi-plus-circle me-1"></i> Create Post</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['name']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/miniblog/dashboard.php">Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/miniblog/logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/miniblog/login.php"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/miniblog/register.php"><i class="bi bi-person-plus me-1"></i> Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php
if (isset($_SESSION['flash'])) {
    foreach ($_SESSION['flash'] as $type => $msg) {
        echo '<div class="alert alert-'.$type.' alert-dismissible fade show">'.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    unset($_SESSION['flash']);
}
?>