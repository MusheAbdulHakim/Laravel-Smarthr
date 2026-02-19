# Deployment Guide

## Server Requirements

*   **OS**: Linux (Ubuntu 22.04+ recommended)
*   **Web Server**: Nginx
*   **PHP**: 8.4 (Extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
*   **Database**: MySQL 8.0+
*   **Process Monitor**: Supervisor (for Queues)

## Production Setup Steps

### 1. Code Deployment
```bash
cd /var/www/smarthr
git pull origin main
composer install --no-dev --optimize-autoloader
```

### 2. Permissions
```bash
chown -R www-data:www-data storage bootstrap/cache
```

### 3. Environment
Ensure `.env` has:
```env
APP_ENV=production
APP_DEBUG=false
QUEUE_CONNECTION=redis
```

### 4. Caching
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Frontend Assets
```bash
npm ci
npm run build
```

### 6. Supervisor Configuration (Queues)
File: `/etc/supervisor/conf.d/smarthr-worker.conf`
```ini
[program:smarthr-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/smarthr/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/smarthr/storage/logs/worker.log
```
Run `supervisorctl reread && supervisorctl update`.

### 7. Nginx Configuration
Ensure your Nginx config points to the `public/` directory and passes PHP requests to `php-fpm`.

## Updates
To update the application:
1.  `git pull`
2.  `composer install --no-dev`
3.  `php artisan migrate --force`
4.  `php artisan cache:clear`
5.  `php artisan config:cache`
