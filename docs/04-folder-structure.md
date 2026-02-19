# Folder Structure

This document confirms the high-level folder structure of the Laravel SmartHR application.

## Root Directory

| Directory | Description |
| :--- | :--- |
| `app/` | Core application logic (Models, Controllers, Services). |
| `bootstrap/` | Framework bootstrapping scripts. |
| `config/` | Application configuration files. |
| `database/` | Migrations, Seeders, and Factories. |
| `lang/` | Translation files. |
| `Modules/` | **Key Directory**: Contains all domain modules (Accounting, Sales, etc.). |
| `public/` | entry point for the web server (index.php, compiled assets). |
| `resources/` | Views (Blade), Lang, and uncompiled assets (JS/CSS). |
| `routes/` | Route definitions (`web.php`, `api.php`, `console.php`). |
| `storage/` | Logs, compiled views, and file uploads. |
| `tests/` | Automated tests. |
| `vendor/` | Composer dependencies. |

## `app/` Directory

| Directory | Description |
| :--- | :--- |
| `Console/` | Artisan commands (e.g. `kernel.php`). |
| `Events/` | Event classes (e.g. `TicketReplied`). |
| `Exceptions/` | Custom exception handling. |
| `Http/` | Controllers, Middleware, and Requests. |
| `Jobs/` | Queued jobs (e.g. `SendEmail`). |
| `Listeners/` | Event listeners. |
| `Models/` | Eloquent models for core features. |
| `Notifications/` | Email and system notifications. |
| `Providers/` | Service providers (dependency injection). |
| `Services/` | Business logic services (e.g. `MenuService`). |

## `Modules/` Directory

Each folder in `Modules/` represents a self-contained feature module.

| Module | Description |
| :--- | :--- |
| `Accounting/` | Manages Invoices, Expenses, Budgets. |
| `Project/` | Projects, Tasks, Teams. |
| `Roles/` | Role and Permission management. |
| `Sales/` | Estimates, Leads, Proposals. |
| `Whiteboard/` | Collaborative whiteboard feature. |

### Anatomy of a Module

Inside `Modules/ModuleName/`:

*   `Config/`: Module-specific config.
*   `Database/`: Migrations and Seeders.
*   `Http/`: Controllers specific to this module.
*   `Models/`: Eloquent models specific to this module.
*   `Resources/`: Views (Blade) dedicated to this module.
*   `Routes/`: Routes specific to this module (`web.php`, `api.php`).
