សៀវភៅណែនាំដំឡើង និងប្រើប្រាស់ (សម្រាប់ Quickments)

ខាងក្រោមជាជំហានលម្អិតក្នុងការដំឡើង និងចាប់ផ្តើមប្រព័ន្ធ (ជាភាសាខ្មែរ) — អាន និងអនុវត្តតាមជាកថាខ្លីៗ។

តម្រូវការមុនដំបូង

PHP ≥ 8.3

Composer (latest)

Git

Web server bundle: Laragon ឬ XAMPP (ប្រសិនបើប្រើ Laragon ត្រូវរក្សា project ក្នុង C:\laragon\www ជាធម្មតា; ប្រសិនបើ XAMPP រក្សា ក្នុង C:\xampp\htdocs)

MySQL (អាចមកជាមួយ Laragon/XAMPP)

ជំហានដំឡើង (Commands)

Clone project

git clone https://github.com/sortsom/quickments.git
cd quickments


ប្រសិនបើប្រើ Laragon ឬ XAMPP — សូមត្រូវ clone ទៅ folder www ឬ htdocs ដូចដែលបានលើកលែង។

ចម្លង និងកែ .env

cp .env.example .env


បើ Windows: ចម្លងផ្ទាល់ដោយ Explorer ឬ PowerShell:

copy .env.example .env


កំណត់ Database ក្នុង .env
បើអ្នក belum have database គី BigAdmin/PhpMyAdmin → បង្កើត database ឈ្មោះ quickments (ឬឈ្មោះផ្សេង ប្តូរ DB_DATABASE តាមអត្រា)។

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quickments
DB_USERNAME=root
DB_PASSWORD=


(បំរែបំរួល username/password ប្រសិនបើអ្នកកំណត់ផ្សេង)

ដំឡើង dependence

ជាធម្មតាគួរប្រើ composer install មុន composer update ដើម្បីដកចេញ vendor ពី packagist។

composer install


បង្កើត application key

php artisan key:generate


(បើលេីកឡើង «No application encryption key has been specified.» នោះ command នេះជាការដោះស្រាយ)

ចូលកម្មវិធី database migration

ប្រសិនបើត្រូវ migrate ទាំងអស់:

php artisan migrate


ប្រសិនបើចង់ refresh និង seed (ជាធម្មតាសម្រាប់ dev/testing):

php artisan migrate:refresh --seed


កំណត់: ប្រសិនបើ tables មានហើយ និងបង្ហាញ error table already exists អ្នកអាច migrate:rollback ឬ migrate:fresh --seed (ហានិភ័យលុបទិន្នន័យ)៖

php artisan migrate:rollback
# ឬ (លុប table ទាំងអស់ -> migrate + seed)
php artisan migrate:fresh --seed


(ជាជម្រុញ) បើអ្នកប្រើការផ្ទុកឯកសារ storage (avatar, files)

php artisan storage:link


ចាប់ផ្តើម server (local dev)

ប្រសិនបើប្រើ Laragon/XAMPP -> បើក Apache + MySQL រួចចូល URL ដូចជា http://quickments.test ឬ http://localhost/quickments/public (អាសយដ្ឋានអាស្រ័យលើ configuration)

ប្រសិនបើចង់ run artisan server:

php artisan serve
# បើក http://127.0.0.1:8000

ការចូល (login) — user seeded

បើ project មាន seeder សម្រាប់ user, ទៅកាន់ database/seeders/UserSeeder.php (ឬ Userseeder.php) ហើយមើល username/password ដែលបានកំណត់ (seed)។

ប្រសិនបើ seeder សរសេរ hashed password អ្នកអាចមើល email/username នៅក្នុង seeder ហើយ reset password តាម PhpMyAdmin ប្រសិនចាំបាច់។

ជាគន្លឹះ៖ ប្រសិន UserSeeder មិនបញ្ជាក់ password ដែលអាចចេះបាន ត្រូវ ដាក់យកណាមួយក្នុង seeder ឬ run tinker ដើម្បី update password:

ការពិពណ៌នាបញ្ហាទម្រង់ទូទៅ និងដំណោះស្រាយ

No application encryption key → ហៅ php artisan key:generate

Base table or view already exists → run php artisan migrate:rollback ឬ migrate:fresh --seed

DB connection error → ត្រួតពិនិត្យ .env (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) និងពិនិត្យថា MySQL បានបើក។

Composer memory error (Windows) → ប្រើ composer install --no-dev ឬ បើ Linux, អាច Run COMPOSER_MEMORY_LIMIT=-1 composer install

ពិចារណាបន្ថែម (best practices)

កុំចែក .env នៅក្នុង git repository។

សម្រាប់ production: កំណត់ឲ្យ APP_ENV=production និង APP_DEBUG=false ហើយ configure web server properly (Apache / Nginx) និង SSL។

ប្រើ Git branches ហើយ push/pull មុន commit changes។

សង្ខេបលឿន (Quick checklist)

Clone project → git clone ...

cp .env.example .env ហើយកែ DB។

composer install

php artisan key:generate

php artisan migrate ឬ php artisan migrate:refresh --seed

php artisan storage:link (ប្រសិនបើប្រើ storage)

ដំណើរការ local server (php artisan serve ឬ តាម Laragon/XAMPP)
