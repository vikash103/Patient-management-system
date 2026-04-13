# 🏥 Patient Management System

A web-based Patient Management System built using Laravel. This system allows users to manage doctors, patients, and appointments with role-based authentication.

---

## 🚀 Features

* 🔐 Role-based Authentication (Admin, Doctor, Staff)
* 👨‍⚕️ Doctor Management
* 🧑‍🤝‍🧑 Patient Management
* 📅 Appointment Booking System
* ⏰ Doctor Schedule Management
* 📊 Dashboard Overview
* 📧 Email Notification System (Welcome Email on Registration using Queue)

---

## 👥 User Roles

### 🛡️ Admin

* Manage doctors and patients
* View all appointments

### 👨‍⚕️ Doctor

* View assigned appointments
* Manage schedule

### 🧑‍💼 Staff (Receptionist)

* Manage patient records
* Book appointments for patients
* View appointment details

---

## ⚙️ Queue & Email System

* Implemented Laravel Queue system
* Sends **Welcome Email** after user registration
* Improves performance by handling email in background

---

## 🛠️ Tech Stack

* PHP (Laravel)
* MySQL
* Blade Template
* Tailwind CSS

---

## 📂 Project Structure

* `app/` → Controllers & Models
* `routes/` → Web routes
* `resources/views/` → UI (Blade files)
* `database/` → Migrations

---

## ⚙️ Installation & Setup

1. Clone the repository:
   git clone https://github.com/vikash103/Patient-management-system.git

2. Go to project folder:
   cd Patient-management-system

3. Install dependencies:
   composer install

4. Setup environment file:
   cp .env.example .env

5. Generate app key:
   php artisan key:generate

6. Run migrations:
   php artisan migrate

7. Start server:
   php artisan serve

---

## 🌐 Future Improvements

* 📧 Email Notifications Enhancements
* 📈 Reports & Analytics

---

## 👨‍💻 Author

* Vikash Kumar

---

⭐ If you like this project, give it a star!
