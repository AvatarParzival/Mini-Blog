</div> <!-- /container -->

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="bi bi-pencil-square"></i> Mini Blog</h5>
                <p class="text-muted">A simple blogging platform to share your thoughts with the world.</p>
            </div>
            <div class="col-md-3">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="/miniblog/index.php" class="text-decoration-none text-muted">Home</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="/miniblog/dashboard.php" class="text-decoration-none text-muted">Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="/miniblog/login.php" class="text-decoration-none text-muted">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Connect</h5>
                <a href="#" class="text-muted me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-muted me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-muted me-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-muted me-2"><i class="bi bi-github"></i></a>
            </div>
        </div>
        <hr class="my-4 bg-secondary">
        <div class="text-center text-muted">
            &copy; <?= date('Y') ?> Mini Blog. All rights reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>