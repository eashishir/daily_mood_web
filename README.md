# Daily Mood Tracker Web App

Track your daily mood, view weekly summaries, and earn badges for streaks.

## 🚀 Features
- Daily mood logging with notes
- Weekly summary with chart
- Streak badge for consistent mood logging
- Soft delete and restore moods
- PDF export of mood history
- Mood of the Month
- Responsive UI with Bootstrap 5

## 🛠️ Setup Instructions
```bash
git clone https://github.com/eashishir/daily_mood_web.git
cd daily_mood_web
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
