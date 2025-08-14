<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: /miniblog/login.php'); exit;
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">My Posts</h2>
        <p class="text-muted">Manage your published content</p>
    </div>
    <a class="btn btn-primary" href="/miniblog/create.php">
        <i class="bi bi-plus-circle me-1"></i> Create Post
    </a>
</div>

<?php if (empty($posts)): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-journal-text" style="font-size: 3rem; color: #6c757d;"></i>
            <h4 class="mt-3">No posts yet</h4>
            <p class="text-muted">Start by creating your first post</p>
            <a href="/miniblog/create.php" class="btn btn-primary mt-2">
                <i class="bi bi-plus-circle me-1"></i> Create Post
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>
                            <a href="/miniblog/post.php?id=<?= $post['id'] ?>" class="text-decoration-none">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-success">Published</span>
                        </td>
                        <td>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                <?= date('M j, Y', strtotime($post['created_at'])) ?>
                            </small>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="/miniblog/edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="/miniblog/delete.php?id=<?= $post['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Delete this post?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>