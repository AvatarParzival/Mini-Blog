-- database.sql
-- Mini-Blog schema + sample data
-- Run once inside XAMPP (phpMyAdmin or CLI)

-- 1. Create the database
CREATE DATABASE IF NOT EXISTS miniblog
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE miniblog;

-- 2. Users table
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 3. Posts table
CREATE TABLE IF NOT EXISTS posts (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    title      VARCHAR(255) NOT NULL,
    content    TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 4. (Optional) Demo user  ->  password = 123456
INSERT IGNORE INTO users (name, email, password)
VALUES ('Demo User', 'demo@miniblog.local',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 5. (Optional) Demo post
INSERT IGNORE INTO posts (user_id, title, content)
VALUES (1, 'Welcome to Mini-Blog',
        'This is your first post. Feel free to edit or delete it!');