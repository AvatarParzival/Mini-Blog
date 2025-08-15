</main>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        important: '#tailwind-footer',
        theme: {
            extend: {
                colors: {
                    dark: '#0f172a',
                    light: '#f8fafc'
                }
            }
        }
    }
</script>

<div id="tailwind-footer">
    <footer class="bg-gradient-to-br from-dark to-indigo-900 text-light py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8"> 

                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center mb-2">
                        <div class="bg-indigo-500 w-8 h-8 rounded-lg flex items-center justify-center mr-2">
                            <i class="bi bi-pencil-square text-white text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold text-white">MiniBlog</h2>
                    </div>
                    <p class="text-gray-300 text-xs mb-2">
                        Sharing ideas and insights
                    </p>
                </div>

                <div class="flex flex-col items-center">
                    <h3 class="text-md font-semibold text-white mb-2">Navigation</h3> 
                    <ul class="space-y-1"> 
                        <li><a href="/miniblog/index.php" class="text-gray-300 hover:text-white text-xs transition">Home</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="/miniblog/dashboard.php" class="text-gray-300 hover:text-white text-xs transition">Dashboard</a></li>
                        <?php else: ?>
                            <li><a href="/miniblog/login.php" class="text-gray-300 hover:text-white text-xs transition">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="flex flex-col items-center">
                    <h3 class="text-md font-semibold text-white mb-2">Connect</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="text-gray-300 hover:text-white transition hover:scale-110 text-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition hover:scale-110 text-sm">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-4 pt-3 text-center"> 
                <p class="text-gray-400 text-xs"> 
                    &copy; <?= date('Y') ?> MiniBlog. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>