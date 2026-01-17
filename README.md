# Learnify

🎓 Learnify is a Laravel-based web platform for online learning and course management.

Built to help students learn easily and help instructors manage materials, classes, and users in one place.

![License](https://img.shields.io/github/license/PengenNgoding/learnifyWeb?style=plastic)

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

---

## ✨ Features

- User authentication (student & admin)
- Course & material management
- Learning progress tracking
- Clean UI with responsive design
- Laravel MVC architecture
- MySQL database support

---

## 🛠 Tech Stack

- **Backend**: Laravel 8
- **Frontend**: Blade, Bootstrap, JavaScript
- **Database**: MySQL
- **Version Control**: Git & GitHub

---

## 🚀 Installation

```bash
git clone https://github.com/PengenNgoding/learnifyWeb.git
cd learnifyWeb
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
