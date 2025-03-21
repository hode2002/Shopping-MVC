# 🛒 Shopping-MVC

A modern PHP MVC application for an online shopping platform.

## 📋 Project Overview

This application is built using the Model-View-Controller (MVC) architectural pattern in PHP, providing a structured approach to developing a professional shopping website with clean separation of concerns.

## ⚙️ Requirements

- 🐘 PHP 7.4+
- 🗄️ MySQL
- 📦 Composer
- 🖥️ Web server (Apache)

## 🚀 Installation

1. 📥 Clone this repository:
   ```
   git clone https://github.com/hode2002/Shopping-MVC.git
   ```

2. 📦 Install dependencies:
   ```
   composer install
   ```

3. 🗃️ Create a database using the SQL script:
   ```
   mysql -u username -p database_name < database.sql
   ```

4. ⚙️ Configure your environment variables:
   - Copy `.env.example` to `.env` (if not already created)
   - Update the database credentials and other settings

5. 🔧 Set up your web server:
   - Use the included `vhost.txt` as a reference for Apache configuration
   - Ensure the document root points to the `public` directory

## 📁 Project Structure

- 📂 `src/` - Application source code (Models, Views, Controllers)
- 🌐 `public/` - Publicly accessible files (CSS, JS, entry point)
- 📚 `vendor/` - Composer dependencies
- 💾 `database.sql` - Database schema and initial data

## 🔍 Usage

Access the application through your web browser at the configured domain. Browse products, add items to cart, and complete purchases through the intuitive user interface.

## 👥 Contributors

Lâm Thanh Vỹ - Initial work

Nguyễn Thành Lợi - Initial work

