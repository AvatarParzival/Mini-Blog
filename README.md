# Mini-Blog Project
![XAMPP Compatible](https://img.shields.io/badge/XAMPP-Compatible-brightgreen)
![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue)
![MySQL Ready](https://img.shields.io/badge/MySQL-5.7%2B-orange)
  <img src="https://upload.wikimedia.org/wikipedia/commons/3/3b/Javascript_Logo.png" alt="JavaScript" width="40" height="30"/>
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/HTML5_logo_and_wordmark.svg" alt="HTML5" width="40" height="30"/>
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/CSS3_logo_and_wordmark.svg" alt="CSS3" width="40" height="30"/>

## Overview

Mini-Blog is a simple blogging platform built with PHP, MySQL, and Bootstrap. It allows users to register, login, create, edit, and delete blog posts. The project features a responsive design with a focus on clean and modern aesthetics.

## Features

- **User Authentication**: Secure registration and login system.
- **CRUD Operations**: Create, read, update, and delete blog posts.
- **Responsive Design**: Works well on both desktop and mobile devices.
- **Search Functionality**: Search posts by title or content.
- **Pagination**: Efficiently navigate through multiple pages of blog posts.

## Technologies Used

- **PHP**: Backend scripting language.
- **MySQL**: Database management system.
- **HTML/CSS**: Markup and styling languages.
- **JavaScript**: For dynamic interactions and animations.
- **Bootstrap**: Front-end framework for responsive design.

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- XAMPP (or any other PHP development environment)

## Setup Instructions

### Using XAMPP

1. **Install XAMPP**:
   - Download and install XAMPP from [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html).
   - Start Apache and MySQL services from the XAMPP control panel.

2. **Create a Database**:
   - Create a new database named `miniblog` in phpMyAdmin (`http://localhost/phpmyadmin`).
   - Import the SQL schema provided in the `database.sql` file into the `miniblog` database.

3. **Clone or Download the Repository**:
   - Clone the repository using `git clone https://github.com/AvatarParzival/Mini-Blog` or download the ZIP and extract it.
   - Move the extracted files into the `htdocs` directory of your XAMPP installation (`xampp/htdocs/`).

4. **Update Database Credentials**:
   - Open `config/db.php` and ensure it contains the correct database credentials:
     ```php
     $host = 'localhost';
     $db   = 'miniblog';
     $user = 'root';    // or your MySQL username
     $pass = '';       // or your MySQL password
     ```

5. **Access the Blog**:
   - Open your browser and navigate to `http://localhost/miniblog/`.
   - You can now register a new account or log in with an existing one.

6. **Create Posts**:
   - Once logged in, you can create new posts from the "Create Post" link in the navigation bar.

## Directory Structure
```
miniblog/
│
├── config/
│   └── db.php          # Database configuration file
│
├── partials/
│   ├── header.php      # Header partial for navigation
│   └── footer.php      # Footer partial
│
├── index.php           # Homepage displaying blog posts
├── register.php        # User registration page
├── login.php           # User login page
├── logout.php          # User logout page
├── dashboard.php       # User dashboard showing their posts
├── create.php          # Page for creating new blog posts
├── edit.php            # Page for editing existing blog posts
├── delete.php          # Page for deleting blog posts
├── post.php            # Single post view page (optional)
└──  database.sql       # SQL file for creating database schema
```

### General Notes

- Ensure all PHP files are saved with UTF-8 encoding to prevent any character encoding issues.
- The project assumes that you have basic knowledge of PHP and MySQL.
- This project is for educational purposes and may require additional features or security enhancements for production use.

## Contributing

Feel free to contribute to the project by submitting pull requests or reporting issues. Any contributions should follow the existing coding standards and include relevant documentation.
