
# orccoAPP

A Laravel application for managing reports, projects, employees, and clients for ORCCO.

---

### LINUX

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Building for Production](#building-for-production)
- [Common Commands](#common-commands)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

---

## Prerequisites

Make sure your system has:

```bash
php -v         # PHP >= 8.4
composer -V    # Composer installed
node -v        # Node.js >= 16
npm -v         # npm installed
mysql --version  # MySQL/MariaDB installed
```

Also enable necessary PHP extensions:

```bash
php -m | grep -E "pdo_mysql|mysqli|bcmath|intl"
```

---

## Installation

Clone and set up the project:

```bash
git clone https://github.com/orcco1/orccoAPP.git
cd orccoAPP
composer install
npm install
```

---

## Environment Configuration

Copy the `.env` file and set up the app key:

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---

## Database Setup

Start MariaDB:

```bash
sudo systemctl enable --now mariadb
```

Enter the database console:

```bash
sudo mariadb
```

Then inside MariaDB:

```sql
CREATE DATABASE orccoApp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON orccoApp.* TO 'user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Back in your terminal, run migrations:

```bash
php artisan migrate
```

Or to reset everything:

```bash
php artisan migrate:fresh
```

---

## Running the Application

To start the Laravel server:

```bash
php artisan serve
```

This runs the app at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

To compile frontend assets for development:

```bash
npm run dev
```

---

## Building for Production

Prepare the frontend assets:

```bash
npm run build
```

Cache configuration:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Update `.env` for production:

```dotenv
APP_ENV=production
APP_DEBUG=false
```

---

## Common Commands

Useful Artisan and Laravel commands:

```bash
php artisan route:list
php artisan cache:clear
php artisan config:clear
php artisan optimize:clear
php artisan db:seed
php artisan migrate
php artisan migrate:fresh
php artisan tinker
php artisan test
```

---

## Project Structure

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

## Contributing

```bash
git clone https://github.com/your-username/orccoAPP.git
cd orccoAPP
git checkout -b feature/YourFeature
git commit -am "Add your feature"
git push origin feature/YourFeature
```

---

### Windows

#### Prerequisites

Make sure you have:

- [XAMPP](https://www.apachefriends.org/index.html) or [Laragon](https://laragon.org/)
- PHP ≥ 8.4
- Composer
- Node.js ≥ 16 and npm

#### Steps

1. **Clone the repository**

```bash
git clone https://github.com/orcco1/orccoAPP.git
cd orccoAPP
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install Node dependencies**

```bash
npm install
```

4. **Copy `.env` file and set the app key**

```bash
copy .env.example .env
php artisan key:generate
```

5. **Configure the `.env` file** with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=orccoApp
DB_USERNAME=root
DB_PASSWORD=
```

6. **Create the database** using phpMyAdmin or MySQL console (included in XAMPP/Laragon):

```sql
CREATE DATABASE orccoApp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

7. **Run migrations**

```bash
php artisan migrate
```

8. **Run the development server**

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

9. **Compile frontend assets**

```bash
npm run dev
```

---

## License

This project is licensed under the MIT License.  
© 2025 ORCCO
