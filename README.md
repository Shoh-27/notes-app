# 📝 Laravel Notes App

Laravel asosida yozilgan oddiy **Notes App**.  
Har bir foydalanuvchi o‘z notelarini yaratishi, tahrirlashi va boshqarishi mumkin.  
Admin esa kategoriyalarni qo‘shishi va boshqarishi mumkin.

---

## 🚀 Features

✅ User authentication (login/register)  
✅ Create, edit, delete notes  
✅ Each user sees only their own notes  
✅ Pin / Archive notes  
✅ Search notes (title, content)  
✅ Categories (admin only)  
✅ Dark mode (optional)  
✅ Password-protected notes

---

## 🛠 Tech Stack

- [Laravel 10](https://laravel.com/) (Backend, Auth, Eloquent ORM)  
- [MySQL](https://www.mysql.com/) (Database)  
- [Bootstrap 5](https://getbootstrap.com/) (Frontend UI)  

---

## ⚙️ Installation

```bash
# 1. Clone repository
git clone https://github.com/Shoh-27/notes-app.git

# 2. Enter project folder
cd notes-app

# 3. Install dependencies
composer install

# 4. Copy .env file and set DB config
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Run migrations
php artisan migrate

# 7. Start local server
php artisan serve
