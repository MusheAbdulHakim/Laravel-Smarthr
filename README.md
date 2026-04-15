# Laravel SmartHR

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)

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

```bash
# Clone the repo
git clone https://github.com/your-repo/laravel-smarthr.git

# Install dependencies
composer install
npm install

# Setup Environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --seed

# Run things
npm run dev
php artisan serve
```

See [Installation Guide](docs/02-installation.md) for full details.

---

## 🤝 Contributing

We welcome contributions! Please see our [Contribution Guide](docs/12-contribution-guide.md) for details on our code standards and pull request process.

## 📄 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
