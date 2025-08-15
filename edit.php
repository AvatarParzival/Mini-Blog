<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['user_id'])) { header('Location: /miniblog/login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$post = $stmt->fetch();
if (!$post) { header('Location: /miniblog/dashboard.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title === '' || $content === '') {
        $_SESSION['flash']['danger'] = 'Title and content required.';
    } else {
        $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?")
            ->execute([$title, $content, $id]);
        $_SESSION['flash']['success'] = 'Post updated successfully!';
        header('Location: /miniblog/dashboard.php'); exit;
    }
}
?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Edit Post</h2>
            <a href="/dashboard.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        
        <form method="post">
            <div class="mb-4">
                <label for="title" class="form-label fw-bold">Post Title</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" 
                       value="<?= htmlspecialchars($post['title']) ?>" required>
                <div class="form-text">Make it catchy and descriptive</div>
            </div>
            
            <div class="mb-4">
                <label for="content" class="form-label fw-bold">Content</label>
                <textarea name="content" id="content" class="form-control" rows="12" required><?= 
                    htmlspecialchars($post['content']) 
                ?></textarea>
                <div class="form-text">Markdown is supported</div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/miniblog/post.php?id=<?= $post['id'] ?>" class="btn btn-outline-primary me-md-2">
                    <i class="bi bi-eye"></i> View Post
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>