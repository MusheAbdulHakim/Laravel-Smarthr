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

3. Install dependencies

	- Composer

	```
	composer install

	```
	- Npm
	```
	npm install && npm run build
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

### Make sure you setup pusher to use the chatapp
(Chat App Docs)[https://chatify.munafio.com/]

#screenshots

![ScreenShot](screenshots/login.png?raw=true "Login page")
![Dashboard](screenshots/dashboard.png?raw=true "Dashbaord page")
![Dashboard](screenshots/clients.png?raw=true "Clients page")
![Dashboard](screenshots/employees.png?raw=true "employees page")

# Theme
 https://themeforest.net/item/smarthr-bootstrap-admin-panel-template/21153150


### Checkout a complete version of the application with much more features here
[Premium Demo](https://hr.musheabdulhakim.dev/)
->credentials
	email: super@admin.com
	password: admin