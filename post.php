<?php
require_once __DIR__ . '/partials/header.php';
$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT posts.*, users.name AS author
                       FROM posts
                       JOIN users ON users.id = posts.user_id
                       WHERE posts.id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) { header('Location: /miniblog/index.php'); exit; }
?>
<h2><?= htmlspecialchars($post['title']) ?></h2>
<p class="text-muted">By <?= htmlspecialchars($post['author']) ?> on <?= date('M j, Y', strtotime($post['created_at'])) ?></p>
<div><?= nl2br(htmlspecialchars($post['content'])) ?></div>
<a href="/miniblog/index.php" class="btn btn-secondary mt-4">← Back to feed</a>
<?php require_once __DIR__ . '/partials/footer.php'; ?>