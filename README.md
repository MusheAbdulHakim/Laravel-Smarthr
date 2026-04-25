<div align="center">
    <img src="./public/images/main-logo.png"  height="100%" width="40%" alt="logo">
</div>
<hr>

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Issues](https://img.shields.io/github/issues/MusheAbdulHakim/laravel-smarthr?style=for-the-badge&logo=php&logoColor=white)](https://github.com/MusheAbdulHakim/Laravel-Smarthr)
[![Forks](https://img.shields.io/github/forks/MusheAbdulHakim/laravel-smarthr?style=for-the-badge&logo=php&logoColor=white)](https://github.com/MusheAbdulHakim/Laravel-Smarthr/fork)
[![Stars](https://img.shields.io/github/stars/MusheAbdulHakim/laravel-smarthr?style=for-the-badge&logo=php&logoColor=white)](https://github.com/MusheAbdulHakim/Laravel-Smarthr)

**Laravel SmartHR** is an enterprise-grade Human Resource Management System (HRMS) designed for modularity, scalability, and ease of use. It handles everything from employee management to complex payroll and project tracking.

---

## 📚 Documentation

We have comprehensive developer documentation available in the `docs/` directory:

- [**01. Overview**](docs/01-overview.md) - System capabilities and architecture.
- [**02. Installation**](docs/02-installation.md) - Step-by-step setup guide.
- [**03. Architecture**](docs/03-architecture.md) - Deep dive into the modular monolith design.
- [**04. Folder Structure**](docs/04-folder-structure.md) - Where everything lives.
- [**05. Database Schema**](docs/05-database-schema.md) - Tables and relationships.
- [**06. Authentication & Permissions**](docs/06-authentication-authorization.md) - RBAC system explained.
- [**07. Modules**](docs/07-modules-explained/) - Detailed guides for Accounting, Sales, Projects, etc.
- [**08. API Documentation**](docs/08-api-documentation.md) - REST API reference.
- [**12. Contribution Guide**](docs/12-contribution-guide.md) - How to contribute code.

---

## 🚀 Key Features

*   **Modular Architecture**: Business logic is separated into independent modules (Accounting, Sales, Projects).
*   **Employee Management**: Complete lifecycle management.
*   **Payroll System**: Automated salary calculation with allowances and deductions.
*   **Project Management**: Kanban boards, task tracking, and team collaboration.
*   **Invoicing & Accounting**: Create estimates, convert to invoices, and track expenses.
*   **Role-Based Access**: Granular permissions for Super Admin, HR, Manager, and Employee.

---

## 🛠️ Quick Start
Follow these steps below to install the application.

Or Watch the installation process on [Youtube](https://youtu.be/UHkrsyBcMRM)

- Clone the repository using your termina or command prompt
```bash
git clone https://github.com/MusheAbdulHakim/laravel-smarthr.git smarthr
```

```
cd smarthr
```

- Install dependencies
    - Composer

	```
	composer install
	```
	- For npm users
	```
	npm install && npm run build
	```
	- Or if youre using PNPM
	```
	pnpm install && pnpm run build
	```

- Create your database

- Rename .env.example to .env Or copy and paste at project root directory and rename the file .env .You can also use this command.

```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```
- Install Reverb

Refer to the Reverb Documentation on how to setup and run the server. <a href="https://laravel.com/docs/12.x/reverb" target="_blank"> Laravel Reverb </a>
```
php artisan reverb:install
```


- Set database connection to your database in the .env file. Make sure to set APP_URL to make your domain.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smarthr
DB_USERNAME=root
DB_PASSWORD=

```

- Run migrations and seeders
```
php artisan migrate:fresh --seed; php artisan module:migrate --all --seed
```

- Create Symlink
```
php artisan storage:link
```

### Make sure you give the /storage and /bootstrap/cache folder the permission to read and right 

In linux run
```
sudo chmod -R 777 storage bootstrap/cache
```

- Visit your application domain/url in the browser or Start the local server with and follow the link 
```
php artisan serve
```
## To run the local server, queus, pail and reverb at the same time, run: 
```base
composer run dev
```

### Login Credentials

- Admin
```
 email: superadmin@smarthr.com
 password: password
```

- Employee
```
 email: employee@smarthr.com
 password: password
```

- Client
```
 email: client@smarthr.com
 password: password
```



## Screenshots

![TLDRAW](screenshots/tldraw.png?raw=true "TLD RAW")
![Excalidraw](screenshots/excalidraw.png?raw=true "Excalidraw RAW")
![Login](screenshots/login.png?raw=true "Login page")
![Add Taskboard](screenshots/add-taskboard.png?raw=true "Add Taskboard")
![Employee Dashboard](screenshots/employee-dashboard.png?raw=true "Employee Dashboard")
![Attendance Table](screenshots/attendance-table.png?raw=true "Attendance Table")
![Attendance](screenshots/adminview-attendance-details.png?raw=true "Admin View of Attendance")
![Projects](screenshots/projects-grid.png?raw=true "Projects Card View")
![Project Details](screenshots/project-details.png?raw=true "Project Details")
![Ticket Chat](screenshots/ticket-chat.png?raw=true "Ticket chat")
![Payslip](screenshots/payslip.png?raw=true "Payslip")
![Payslip Items](screenshots/payslip-items.png?raw=true "Payslip Items")
![Chat App](screenshots/chat-app.png?raw=true "Payslip Items")

- Star the repository and report any issues/bugs you encounter here in the repository.



## Note
In order for the chat app to be working with realtime communication, you'll need to setup [Reverb](https://laravel.com/docs/12.x/reverb), Run the reverb server **php artisan reverb:start** and listen for events with **php artisan queue:listen**

See [Installation Guide](docs/02-installation.md) for full details.

---

## 🤝 Contributing

We welcome contributions! Please see our [Contribution Guide](docs/12-contribution-guide.md) for details on our code standards and pull request process.

## 📄 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
