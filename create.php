<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['user_id'])) { header('Location: /miniblog/login.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title === '' || $content === '') {
        $_SESSION['flash']['danger'] = 'Title and content required.';
    } else {
        $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?,?,?)")
            ->execute([$_SESSION['user_id'], $title, $content]);
        $_SESSION['flash']['success'] = 'Post created successfully!';
        header('Location: /miniblog/dashboard.php'); exit;
    }
}
?>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Create Post</h2>
            <a href="/miniblog/dashboard.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter post title..." required>
                <div class="form-text">Make it catchy and descriptive</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="8" placeholder="Write your post content here..." required></textarea>
                <div class="form-text">Markdown is supported</div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Publish
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>