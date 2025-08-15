<?php
session_start();
require_once __DIR__ . '/config/db.php';
if (!isset($_SESSION['user_id'])) { header('Location: /login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

$_SESSION['flash']['success'] = 'Post deleted.';
header('Location: /miniblog/dashboard.php');