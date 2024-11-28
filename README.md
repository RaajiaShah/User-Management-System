# User Management System

A user management system built with CodeIgniter 3 that allows users to register, log in, and manage their account information.

---

## Project Setup

### Pre-requisites

1. Install a local server environment like XAMPP or WAMP.
2. Clone this repository into the `htdocs` folder (XAMPP) or the root directory of your server.

---

### Steps to Run

1. Start the Apache and MySQL services in your server environment.
2. Import the database:
   - Open `phpMyAdmin` in your browser.
   - Create a new database named `user_management` (or any name of your choice).
   - Import the SQL file located in the `Database/user_management.sql` folder.
3. Configure the database connection:
   - Open `application/config/database.php`.
   - Update the database credentials:
     ```php
     'hostname' => 'localhost',
     'username' => 'root', // Use your database username
     'password' => '',     // Use your database password
     'database' => 'user_management', // Name of your imported database
     ```

4. Navigate to the project in your browser:
   - Registration Page: [http://localhost:8080/User-Management-System/User_Management_System/register](http://localhost:8080/User-Management-System/User_Management_System/register)
   - Login Page: [http://localhost:8080/User-Management-System/User_Management_System/login](http://localhost:8080/User-Management-System/User_Management_System/login)

---

## Features

- **User Registration**
- **User Login**
- **User Logout**
- **View Account Information**
- **Modify Account Information**
- **Delete Account Information**

---

## Known Issues

- The base URL [http://localhost:8080/User-Management-System/User_Management_System/](http://localhost:8080/User-Management-System/User_Management_System/) shows a 404 error because the default controller is not set in `application/config/routes.php`.
- Users must navigate to specific URLs (e.g., `/register` or `/login`) to access the system.

---

## Project Folder Structure

```plaintext
User-Management-System/
├── Database/
│   └── user_management.sql
├── User_Management_System/
    ├── application/
    ├── assets/
    ├── system/
    └── .htaccess


---

Credits

This project was developed using the CodeIgniter 3 framework. For more information about CodeIgniter, visit https://codeigniter.com.