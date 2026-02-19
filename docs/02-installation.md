# Installation Guide

This guide details the steps to set up **Laravel SmartHR** for local development or production deployment.

## Prerequisites

Ensure your environment meets the following requirements:

*   **PHP**: 8.4 or higher
*   **Composer**: Latest version
*   **MySQL**: 8.0 or higher
*   **Node.js & NPM**: LTS version (for building assets)
*   **Web Server**: Nginx or Apache

## Step-by-Step Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-repo/laravel-smarthr.git
cd laravel-smarthr
```

### 2. Install PHP Dependencies

```bash
composer install
```
*Note: This will also install module dependencies defined in `Modules/*/composer.json`.*

### 3. Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_smarthr
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Setup Storage Linking

Link the public storage directory to verify file uploads work correctly:

```bash
php artisan storage:link
```

### 6. Run Migrations and Seeders

Run the database migrations to create the tables:

```bash
php artisan migrate
```

Seed the database with default roles, permissions, and an admin user:

```bash
php artisan db:seed
```

> **Note:** The `DatabaseSeeder` will call `UserSeeder` and `RolesDatabaseSeeder` to set up the initial Super Admin account and permissions structure.

### 7. Install Frontend Dependencies & Build

```bash
npm install
npm run build
```

For development with hot-reloading:

```bash
npm run dev
```

### 8. Queue Configuration

The application uses queues for background tasks (e.g., email notifications). Ensure your `.env` is configured (default is `database`).

To run the queue worker locally:
```bash
php artisan queue:work
```

### 9. Scheduler (Cron Jobs)

For production, add the following Cron entry to your server to handle scheduled tasks (like recurring invoices or attendance checks):

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Troubleshooting

*   **Permission Issues**: Ensure `storage/` and `bootstrap/cache/` are writable by the web server user.
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```
*   **Module Discovery**: If modules are not loading, run:
    ```bash
    composer dump-autoload
    php artisan package:discover
    ```
