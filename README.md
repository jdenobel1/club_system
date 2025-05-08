Instructions for installing the club system 
1. Import the club_system.sql via phpMyAdmin.
2. Upload files to public_html.
3. Edit db.php with DB credentials.

CLUB SYSTEM - INSTALLATION GUIDE
=================================

1) UPLOAD FILES
---------------
- Upload all PHP, CSS, JS files.
- Make sure `db.php`, `login.php`, etc. are all in the same folder.

2) CREATE DATABASE
------------------
- Open "phpMyAdmin"
- Create a new database: club_system
- Select the database, then go to "Import"
- Choose the file `install.sql` and execute import.

3) CONFIGURE DATABASE CONNECTION
--------------------------------
- Open `db.php`
- Update the following details:
    - DB_HOST: usually `localhost`
    - DB_NAME: `club_system`
    - DB_USER: your database username
    - DB_PASS: your database password

4) DEFAULT LOGIN CREDENTIALS
----------------------------
Teacher/Admin Login:
- URL: /login.php
- Username: admin
- Password: adminpass

(You can change passwords using PHP's password_hash function)

5) PAGES
--------
- login.php  --> Login form
- logout.php --> Log out
- student_signup.php --> Students sign up for clubs
- teacher_assign.php --> Teachers assign tutoring
- checkin.php --> Students check in
- admin_report.php --> Admin view + export report

6) SECURITY NOTE
----------------
- Passwords are hashed (secure)
- Recommend using HTTPS on your hosting (SSL)
- Change default admin password immediately

7) OPTIONAL
-----------
- Use DataTables export buttons on admin_report.php to download CSV/Excel.

Enjoy your new club & tutoring check-in system!



🟢 Default Login Credentials (set in login.php):
Username	Password
teacher1	password123
admin	adminpass
✅ Full Working System Components:
File	Purpose
db.php	Database connection 🔌
student_signup.php	Student club sign-up 📋
teacher_assign.php	Teacher assigns tutoring 📚
checkin.php	Student check-in attendance ✔️
admin_report.php	Admin report + search 📊
login.php	Teacher/Admin login 🔐
logout.php	Session logout 🚪
