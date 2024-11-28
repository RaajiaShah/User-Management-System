# User Management System

A user management system built with CodeIgniter 3. This project allows users to register, login, and manage their accounts.

---

## **Project Setup**

### **Pre-requisites**
1. Install a local server environment like [XAMPP](https://www.apachefriends.org/) or [WAMP](http://www.wampserver.com/).
2. Clone this repository into the `htdocs` folder (XAMPP) or the root directory of your server.

### **Steps to Run**
1. Start the Apache and MySQL services in your server environment.
2. Import the database:
   - Open `phpMyAdmin` in your browser.
   - Create a new database named `user_management`.
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
   - Base URL: [http://localhost:8080/User-Management-System/User_Management_System/](http://localhost:8080/User-Management-System/User_Management_System/)
   - If the above URL doesn’t load, use [http://localhost:8080/User-Management-System/User_Management_System/register](http://localhost:8080/User-Management-System/User_Management_System/register).

---

## **Features**
- User Registration
- User Login
- Password Reset
- Role-Based Access Control (RBAC)

---

## **Project Folder Structure**
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

Known Issues

The base URL might display a "404 - Page Not Found" error. If this happens, ensure the default controller is set up correctly in application/config/routes.php:

$route['default_controller'] = 'register'; // Adjust as needed


---

### **What if You Can’t Fix the Default Controller?**
If you’re unable to set the `default_controller`, mention in your README file that users should navigate to the `/register` URL directly:
```markdown
- Navigate to the registration page:  
  [http://localhost:8080/User-Management-System/User_Management_System/register](http://localhost:8080/User-Management-System/User_Management_System/register)