# ToDoHive

ToDoHive is a PHP/MySQL based task and project management web application built to run on a local LAMP/WAMP/XAMPP stack. It provides user and admin interfaces for creating projects, sprints, tasks, subscriptions and sending email notifications.

## Key features

- User registration, login, password reset (OTP/email flows)
- Project, Sprint and Task management (create, edit, delete)
- Task status updates and details pages
- Admin panel for managing plans/subscriptions
- Email notification integration (PHPMailer present in `mail/`)
- Simple subscription/payment pages

## Tech stack

- PHP (Vanilla)
- MySQL (or MariaDB)
- Front-end: HTML, CSS, JavaScript (plain)
- PHPMailer (for outgoing mail)

## Requirements

- XAMPP (recommended) or any PHP + MySQL environment
- PHP 7.4+ (verify compatibility with your environment)
- MySQL or MariaDB

## Quick setup (Windows + XAMPP)

1. Put the project in your webroot (example path):

	- XAMPP htdocs: `C:\xampp\htdocs\ToDoHive`

2. Start Apache and MySQL from the XAMPP Control Panel.

3. Create the database and import the schema file `todohive.sql`:

	- Using phpMyAdmin: Open http://localhost/phpmyadmin, create a new database (e.g. `todohive`) and import `todohive.sql`.
	- Or using MySQL CLI (PowerShell example):

```powershell
# open PowerShell and run (adjust paths and username as needed)
# create DB first (if not created in the SQL file)
# mysql -u root -p -e "CREATE DATABASE todohive CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
# import SQL file
# "C:\xampp\mysql\bin\mysql.exe" -u root -p todohive < "C:\path\to\ToDoHive\todohive.sql"
```

4. Configure database credentials

	- Update `admin/connection.php` and `user/connection.php` to match your DB host, username, password, and database name. Example:

```php
<?php
$servername = "localhost";
$username = "root";
$password = ""; // default for XAMPP
$dbname = "todohive";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
?>
```

5. (Optional) Configure email settings

	- The `mail/` folder contains PHPMailer files and sample token scripts. Update mail configuration (SMTP host, username, password, port, encryption) where PHPMailer is initialized.

6. Open the app in your browser

	- If you placed the app in `C:\xampp\htdocs\ToDoHive`, visit:

```
http://localhost/ToDoHive/
```

## Important files & directories

- `todohive.sql` — database schema and seed data
- `admin/` — admin pages (plans, subscriptions, admin connection)
- `user/` — user-facing pages (login, signup, dashboard, tasks, profile)
- `mail/` — PHPMailer library and mail helper scripts
- `css/`, `user/css/` — styles used by admin and user pages
- `js/` and `user/js/` — front-end scripts

## How to use

- Register a new user via `user/signup.php` (or `user/login.php` if accounts already exist).
- Create a project (`user/add_project.php`), add sprints and tasks, then track progress from the dashboard.
- Admin functions for plan management are available under `admin/` pages — ensure admin credentials are present in the database.

## Troubleshooting

- Blank page / PHP error: enable display errors temporarily or check `apache\logs\error.log`; ensure `display_errors` is enabled for debugging.
- Database connection failed: verify credentials in `admin/connection.php` and `user/connection.php` and that MySQL is running.
- Email not sending: confirm SMTP settings and that your host allows outbound SMTP; check PHPMailer debug output.
- Permission issues: on some environments, file/folder permissions may need adjusting.











