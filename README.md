# 🌤️ Daily Mood Tracker Web App

A Laravel-based mood tracking web application that allows users to log, review, and analyze their moods on a daily basis.

---

## 🚀 Features

- 📝 **Daily Mood Logging**: Users can submit their daily mood with optional notes.
- 📊 **Weekly Summary Chart**: Visual summary of moods using Chart.js.
- 🏆 **Streak Badge**: Earn badges for logging moods on consecutive days.
- 🏅 **Mood of the Month**: Displays the most frequent mood over the past 30 days.
- 🧾 **PDF Export**: Download full mood log as a PDF report.
- 🧹 **Soft Delete & Restore**: Deleted mood entries can be restored.
- 🔐 **Authentication**: Secure login system for users.

---

## 🛠️ Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or other supported DB
- Node.js & npm

### Installation

```bash
git clone https://github.com/eashishir/daily_mood_web.git
cd daily_mood_web
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
Database Setup
Create a database (e.g., mood_tracker)

Set DB credentials in .env

Run migrations:
