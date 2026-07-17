# 🚀 Laravel 12 Admin Dashboard

A professional Admin Dashboard built with Laravel 12, featuring role-based authentication, Ajax operations, Chart.js visualizations, and complete user management.

## 📸 Screenshots

> <img width="1911" height="906" alt="Screenshot 2026-07-09 085732" src="https://github.com/user-attachments/assets/215f96dd-38f1-4977-b7a5-f0716cb1a189" />


## ✨ Features

- 🔐 Role-based Authentication (Admin/User)
- 📊 Interactive Charts (Bar, Pie, Line)
- 🔍 Ajax Live Search
- ⚡ Ajax Delete without page reload
- 👥 Full User Management (CRUD)
- 🔔 Real-time Notifications with badge
- 📧 Email Password Reset (Gmail SMTP)
- 🖼️ Profile Photo Upload
- 🔒 Change Password with validation
- 📈 Statistics & Data Tables
- 🎨 Beautiful Login/Register UI
- 👁️ Show/Hide Password toggle
- 📱 Responsive Bootstrap 5 Design

## 🛠️ Tech Stack

| Technology | Version |
|-----------|---------|
| Laravel | 12.x |
| PHP | 8.2 |
| MySQL | Latest |
| Bootstrap | 5.3 |
| JavaScript | ES6 |
| Ajax | Fetch API |
| Chart.js | Latest |
| Font Awesome | 6.4 |
| Gmail SMTP | - |

## ⚙️ Installation

**1. Clone the repository**
```bash
git clone https://github.com/fayazahmedsaand123/admin-dashboard.git
cd admin-dashboard
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure database in `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admin_dashboard
DB_USERNAME=root
DB_PASSWORD=
```

**5. Run migrations**
```bash
php artisan migrate
```

**6. Build assets**
```bash
npm run build
```

**7. Start server**
```bash
php artisan serve
```

**8. Set admin role in phpMyAdmin**
```sql
UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
```

## 📧 Email Configuration

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_app_password
```

## 👤 Default Roles

| Role | Access |
|------|--------|
| Admin | Full dashboard access |
| User | Personal dashboard only |

## 📁 Project Structure

```
admin-dashboard/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Notifications/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       └── layouts/
├── routes/
│   └── web.php
├── public/
└── .env.example
```

## 💛 Contact

**Fayaz Ahmed Saand** — Full Stack Web Developer

- 📧 Email: fayazahmedsaand93@gmail.com
- 🎨 Fiverr: [@fayazahmed13](https://www.fiverr.com/fayazahmed13)
- 💼 Upwork: [Fayaz Ahmed](https://www.upwork.com/freelancers/fayazahmed)
- 🌐 Freelancer: [@fayazahmeds9](https://www.freelancer.com/u/fayazahmeds9)
- 🐙 GitHub: [fayazahmedsaand123](https://github.com/fayazahmedsaand123)
## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---
⭐ If you found this project helpful, please give it a star!
