# Quickments – Installation & Usage Guide (Khmer)

README ណែនាំដំឡើង និងប្រើប្រាស់សម្រាប់ **Quickments**។

---

## 🧩 តម្រូវការមុនដំបូង
- **PHP ≥ 8.3**
- **Composer (latest)**
- **Git**
- **Laragon ឬ XAMPP** (Web server)
  - Laragon → `C:/laragon/www`
  - XAMPP → `C:/xampp/htdocs`
- **MySQL** (ភាគច្រើនភ្ជាប់មកជាមួយ Laragon/XAMPP)

---

## 🚀 ការដំឡើង

### 1. Clone Project
```bash
git clone https://github.com/sortsom/quickments.git
cd quickments
```
> កំណត់សំគាល់៖ ប្រើ Laragon/XAMPP ត្រូវ clone ទៅក្នុង **www** ឬ **htdocs**។

---

### 2. ចម្លង និងកែ `.env`
```bash
cp .env.example .env
```
Windows:
```powershell
copy .env.example .env
```

---

### 3. កំណត់ Database នៅក្នុង `.env`
បង្កើត database ឈ្មោះ **quickments** (ឬ ឈ្មោះណាមួយ)។
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quickments
DB_USERNAME=root
DB_PASSWORD=
```
> កែ username/password ប្រសិនបើអ្នកកំណត់ខុស។

---

### 4. ដំឡើង Dependencies
```bash
composer install
```

---

### 5. បង្កើត Application Key
```bash
php artisan key:generate
```
> ដោះស្រាយ "No application encryption key has been specified."

---

### 6. Database Migration
Run migrations:
```bash
php artisan migrate
```
Refresh + seed (សម្រាប់ Dev):
```bash
php artisan migrate:refresh --seed
```
Fix errors:
```bash
php artisan migrate:rollback
# ឬ
php artisan migrate:fresh --seed
```

---

### 7. Storage Link (ជាចាំបាច់បើប្រើ Uploads)
```bash
php artisan storage:link
```

---

### 8. ដំណើរការ Server
Run artisan server:
```bash
php artisan serve
```
Access: `http://127.0.0.1:8000`

Laragon/XAMPP:
- http://quickments.test (Laragon Auto Virtual Host)
- http://localhost/quickments/public

---

## 🔐 ការចូល (Login)
បើមាន Seeder សម្រាប់ Users → ពិនិត្យ `database/seeders/UserSeeder.php`។

បើចង់ Reset Password តាម PhpMyAdmin → update field `password` (bcrypt) ឬ Artisan Tinker។

---

## 🛠️ បញ្ហាទូទៅ និងដំណោះស្រាយ
| បញ្ហា | ដំណោះស្រាយ |
|-------|--------------|
| No application encryption key | `php artisan key:generate` |
| Base table already exists | `migrate:rollback` ឬ `migrate:fresh --seed` |
| DB connection failed | ពិនិត្យ `.env` + បើក MySQL |
| Composer memory error | `composer install --no-dev` ឬ Linux: `COMPOSER_MEMORY_LIMIT=-1` |

---

## ⭐ Best Practices
- កុំ commit `.env` ទៅ GitHub
- Production:
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - Setup SSL + Proper web server config
- ប្រើ Git branches → Pull/Push មុន commit

---

## 📌 Quick Checklist
- [ ] Clone project  
- [ ] ចម្លង `.env` និងកែ DB  
- [ ] `composer install`  
- [ ] `php artisan key:generate`  
- [ ] `php artisan migrate` ឬ `migrate:refresh --seed`  
- [ ] `php artisan storage:link`  
- [ ] Run server → `php artisan serve`  

---

© Quickments – Installation Guide
