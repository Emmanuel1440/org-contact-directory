# Organizations Contact Directory Management System

This Laravel-based system helps manage organizations and their associated contacts for internship or company tracking.

## 🔹 Features

- **Organizations**: Add, edit, filter, deactivate
- **Contacts**: Link contacts to organizations, mark primary
- **Industries**: Classify with tags, filter by industry
- **Dashboard**: Charts, stats, and filters for easy management

## 📦 Built With

- Laravel 10
- Tailwind CSS
- Livewire
- Chart.js
- PostgreSQL

## 🚀 Deployed on

- [Render](https://render.com)

## 📂 Project Setup

```bash
git clone https://github.com/Emmanuel1440/org-contact-directory.git
cd org-contact-directory
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
