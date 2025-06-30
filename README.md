![Screenshot 2025-06-30 093658](https://github.com/user-attachments/assets/25e69d0e-0498-4e4a-9bf1-a883a0df50b4)
![Screenshot 2025-06-30 093622](https://github.com/user-attachments/assets/300d18cc-d731-4f7d-a475-fcad1b0e22d3)
![Screenshot 2025-06-30 093458](https://github.com/user-attachments/assets/059f48ac-2c23-4f48-914b-7ab791e936ff)
![Screenshot 2025-06-30 093426](https://github.com/user-attachments/assets/a8b43a73-2e11-45cd-8aaf-77b35d5053a3)
![Screenshot 2025-06-30 093350](https://github.com/user-attachments/assets/527748af-3570-4797-9b9a-30f3bf9522a3)
![Screenshot 2025-06-30 093326](https://github.com/user-attachments/assets/67655cde-7eef-400b-ace0-ef994dc46c37)
![Screenshot 2025-06-30 093259](https://github.com/user-attachments/assets/512f82ca-d00f-4fe3-be38-879fe8023bf6)
![Screenshot 2025-06-30 093227](https://github.com/user-attachments/assets/2e458b9b-0d04-4555-8868-3c0b6e9729e6)
# 🌤️ Daily Mood Tracker Web App

A Laravel-based mood tracking web application that allows users to log, review, and analyze their moods on a daily basis.

---

## 🚀 Features

 **Daily Mood Logging**: Users can submit their daily mood with optional notes.
- **Weekly Summary Chart**: Visual summary of moods using Chart.js.
   **Streak Badge**: Earn badges for logging moods on consecutive days.
   **Mood of the Month**: Displays the most frequent mood over the past 30 days.
   **PDF Export**: Download full mood log as a PDF report.
   **Soft Delete & Restore**: Deleted mood entries can be restored.
  **Authentication**: Secure login system for users.

---

## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL 
- Node.js & npm

### Installation

```bash
git clone https://github.com/eashishir/daily_mood_web.git
cd daily_mood_web
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
##Database Setup
Create a database (e.g., mood_tracker)

Set DB credentials in .env

Run migrations:php artisan migrate
