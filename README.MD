# Student Course Management System

A robust, PHP-based web application designed to streamline the administration of academic courses, student enrollments, and institutional communication. This system features dual portals tailored for both administrative staff and students, utilizing AJAX for seamless, asynchronous data processing.

---

## 🚀 Key Features

### 👨‍💼 Administrator Portal

- **Comprehensive Dashboard:** Access a centralized view of system metrics and statistics via `admin_dashboard.php`[cite: 10].
- **Student Management:** Register, view, and manage student records using `students.php`[cite: 10].
- **Course & Enrollment Control:** Create academic programs and manage student enrollments through `courses.php` and `enrollment.php`[cite: 10].
- **Communication:** Broadcast announcements directly to the student portal using `manage_notices.php`[cite: 10].
- **Analytics & Search:** Generate financial/enrollment reports and filter records seamlessly via `reports.php` and `search.php`[cite: 10].

### 🎓 Student Portal

- **Personalized Dashboard:** Access enrolled courses and track academic progress via the dedicated `dashboard/student_dashboard.php`[cite: 10].
- **Financial Tracking:** Monitor course fees and payment history using `student_payments.php`[cite: 10].
- **Profile Management:** Update personal information and account security settings through `student_profile.php`[cite: 10].
- **Support Center:** Submit help tickets and inquiries directly to the administration via `student_support.php`[cite: 10].

### ⚙️ Technical & Security Highlights

- **Role-Based Authentication:** Distinct login, registration, and logout processes for admins and students managed within the `Authentication/` directory[cite: 10].
- **AJAX Integration:** Asynchronous data handling for courses, enrollments, notices, and profile updates located in the `ajax/` folder, ensuring no page reloads during CRUD operations[cite: 10].
- **Password Recovery:** Secure password reset flows for all users, supported by `forget_password.php` and `student_forgot_password.php`[cite: 10].
- **Modular UI:** Reusable navigation and layout components stored in the `includes/` directory for maintainability[cite: 10].

---

## 📂 Project Structure

```text
student_course_management/
├── Authentication/      # Admin and Student auth processing scripts
├── ajax/                # Asynchronous handlers for system features
├── assets/js/           # Frontend JavaScript files (main.js)
├── config/              # Database connection (dbcon.php) and auth configuration
├── dashboard/           # Student dashboard views
├── includes/            # Reusable UI components (headers, footers, navbars)
├── index.php            # Main landing page
└── ... (Core PHP pages like courses.php, enrollment.php, reports.php)
```
