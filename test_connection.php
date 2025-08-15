<?php
require_once __DIR__ . '/config/db.php';
try {
    $pdo->query("SELECT 1");
    echo "<h1 style='color:green'>✅ Database connection successful!</h1>";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM posts");
    echo "<p>Posts in database: " . $stmt->fetchColumn() . "</p>";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    echo "<p>Users in database: " . $stmt->fetchColumn() . "</p>";
    
} catch (PDOException $e) {
    echo "<h1 style='color:red'>❌ Database connection failed</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}