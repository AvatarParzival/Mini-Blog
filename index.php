<?php
require_once __DIR__ . '/partials/header.php';

$page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$like   = "%$search%";

$stmt = $pdo->prepare("SELECT posts.*, users.name AS author
                       FROM posts
                       JOIN users ON users.id = posts.user_id
                       WHERE posts.title LIKE ?
                       ORDER BY posts.created_at DESC
                       LIMIT ? OFFSET ?");
$stmt->bindParam(1, $like, PDO::PARAM_STR);
$stmt->bindParam(2, $limit, PDO::PARAM_INT);
$stmt->bindParam(3, $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE title LIKE ?");
$totalStmt->execute([$like]);
$totalPosts = (int) $totalStmt->fetchColumn();
$totalPages = max(1, ceil($totalPosts / $limit));
?>

<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">Latest Posts</h2>
        <p class="text-muted">Discover what others are sharing</p>
    </div>
    <div class="col-md-4">
        <form method="get">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search posts..." value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<?php if (empty($posts)): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-newspaper" style="font-size: 3rem; color: #6c757d;"></i>
            <h4 class="mt-3">No posts found</h4>
            <p class="text-muted">Be the first to create a post!</p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/miniblog/create.php" class="btn btn-primary mt-2"><i class="bi bi-plus-circle"></i> Create Post</a>
            <?php else: ?>
                <a href="/miniblog/login.php" class="btn btn-primary mt-2"><i class="bi bi-box-arrow-in-right"></i> Login to Post</a>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title fw-bold"><?= htmlspecialchars($post['title']) ?></h4>
                        <p class="text-muted mb-3">
                            <i class="bi bi-person"></i> <?= htmlspecialchars($post['author']) ?>
                            <span class="mx-2">•</span>
                            <i class="bi bi-calendar"></i> <?= date('M j, Y', strtotime($post['created_at'])) ?>
                        </p>
                    </div>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/miniblog/edit.php?id=<?= $post['id'] ?>"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="/miniblog/delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this post?')"><i class="bi bi-trash me-2"></i>Delete</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="post-content mb-3">
                    <?= nl2br(htmlspecialchars(mb_substr($post['content'], 0, 200))) ?>...
                </div>
                <a href="/miniblog/post.php?id=<?= $post['id'] ?>" class="btn btn-outline-primary btn-sm">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>&q=<?= urlencode($search) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>
        
        <?php 
        $start = max(1, $page - 2);
        $end = min($totalPages, $page + 2);
        
        if ($start > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=1&q='.urlencode($search).'">1</a></li>';
            if ($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        
        for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&q=<?= urlencode($search) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        
        <?php 
        if ($end < $totalPages) {
            if ($end < $totalPages - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            echo '<li class="page-item"><a class="page-link" href="?page='.$totalPages.'&q='.urlencode($search).'">'.$totalPages.'</a></li>';
        }
        ?>
        
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>&q=<?= urlencode($search) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>