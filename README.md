![Issues](https://img.shields.io/github/issues/MusheAbdulHakim/Laravel-Smarthr)
![Forks](https://img.shields.io/github/forks/MusheAbdulHakim/Laravel-Smarthr)
![Stars](https://img.shields.io/github/stars/MusheAbdulHakim/Laravel-Smarthr)

# Features
- Admin Backend
	1. Contact App
	2. Filemanager app
	3. Employees
	4. Holidays
	5. Employee 
	6. Departments
	7. Designations
	8. Clients
	9. Policies
	10. Jobs
	11. Job Applicants
	12. Assets
	13. Users
	14. Application Settings

- Frontend
	1. Jobs List
	2. View Job
	3. Apply for job

# Installation
 Follow these steps to install the application.

1. Clone the Repository

```
git clone https://github.com/MusheAbdulHakim/Laravel-Smarthr.git

```
2. Go to project directory

```
cd Laravel-Smarthr

```

3. Install packages with composer

```
composer install

```


4. Create your database 

5. Rename .env.example to .env Or copy it and paste at project root directory and name the file .env.You can also use this command.

```
cp .env.example ./.env

```
6. Generate app key with this command
```
php artisan key:generate

```

7. Set database connection to your database in the .env file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smarthr
DB_USERNAME=root
DB_PASSWORD=

```
8. Import smarthr.sql file in the database folder, or run migrations
Use this command to run migrations and seeders

```
php artisan migrate --seed

```
9. Start the local server and browser to your app.
This command will start the development server
```
php artisan serve

```

10. Open the address in the terminal in your browser.Usually address is usually like this:
```
http://127.0.0.1:8000

```
11. Enjoy and make sure to star the repo :).Report bugs,features and also send your pull requests I will be happy to merge them.

# admin login credentials

```
 email: admin@admin.com
 password: admin
```

#screenshots

![ScreenShot](screenshots/login.png?raw=true "Login page")
![Dashboard](screenshots/dashboard.png?raw=true "Dashbaord page")
![Dashboard](screenshots/clients.png?raw=true "Clients page")
![Dashboard](screenshots/employees.png?raw=true "employees page")

# Theme
 https://themeforest.net/item/smarthr-bootstrap-admin-panel-template/21153150

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Laravel-Smarthr
