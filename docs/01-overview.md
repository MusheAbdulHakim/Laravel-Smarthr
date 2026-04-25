# Laravel SmartHR - Overview

## Introduction

**Laravel SmartHR** is an enterprise-grade, modular Human Resource Management System (HRMS) built on **Laravel 12** and **PHP 8.4**. It is designed to help organizations manage their employees, payroll, attendance, projects, and accounting processes efficiently.

The application follows a **Modular Monolith** architecture, ensuring that different business functions (like Payroll, Accounting, Sales) are decoupled yet integrated seamlessy.

## Key System Capabilities

*   **Employee Management**: Complete employee lifecycle management, including details, education, experience, and documents.
*   **Payroll & Compensation**: Automated payroll processing with configurable allowances, deductions, and payslip generation.
*   **Attendance Tracking**: Daily attendance logging with clock-in/clock-out timestamps and location tracking.
*   **Project Management**: Project planning, task boards, team assignment, and progress tracking.
*   **Accounting & Finance**: expense tracking, budget management, invoicing, and tax calculations.
*   **Role-Based Access Control (RBAC)**: Granular permission system for Super Admins, HR, Employees, Clients, and Accountants.
*   **Recruitment**: (If enabled) Job postings and applicant tracking.
*   **Ticketing System**: Internal support ticket system for employee grievances and IT support.

## Intended Users

The system is designed for the following user roles:

1.  **Super Admin**: Full access to all system settings and modules.
2.  **HR Manager**: Manages employees, attendance, holidays, and payroll.
3.  **Employee**: View own profile, payslips, attendance, and managed tasks.
4.  **Accountant**: Manages invoices, expenses, budgets, and taxes.
5.  **Client**: View project progress, invoices, and estimates.

## High-Level Architecture

The system utilizes a modular structured centered around the core Laravel framework.

```ascii
+---------------------------------------------------------------+
|                      User Interface                           |
|           (Blade Templates + Livewire Components)             |
+-------------------------------+-------------------------------+
                                |
                                v
+-------------------------------+-------------------------------+
|                       HTTP Layer                              |
|         (Middleware, Form Requests, API Resources)            |
+-------------------------------+-------------------------------+
                                |
                                v
+-------------------------------+-------------------------------+
|                     Service Layer                             |
|       (Business Logic, Module Services, Job Dispatching)      |
+-------------------------------+-------------------------------+
                                |
                                v
+-------------------------------+-------------------------------+
|                    Domain / Data Layer                        |
|        (Eloquent Models, Repositories, Database Seeds)        |
+-------------------------------+-------------------------------+
                                |
                                v
+---------------------------------------------------------------+
|                       Infrastructure                          |
|      (MySQL Database, Redis Queue, File Storage, Mail)        |
+---------------------------------------------------------------+
```

## Technology Stack

*   **Framework**: Laravel 12
*   **Language**: PHP 8.4
*   **Database**: MySQL 8.0+
*   **Frontend**: Blade, Livewire, Tailwind CSS
*   **Modules**: nwidart/laravel-modules
*   **Permissions**: spatie/laravel-permission
*   **Assets**: Vite for asset compilation


## Screenshots

![TLDRAW](../screenshots/tldraw.png?raw=true "TLD RAW")
![Excalidraw](../screenshots/excalidraw.png?raw=true "Excalidraw RAW")
![Login](../screenshots/login.png?raw=true "Login page")
![Add Taskboard](../screenshots/add-taskboard.png?raw=true "Add Taskboard")
![Employee Dashboard](../screenshots/employee-dashboard.png?raw=true "Employee Dashboard")
![Attendance Table](../screenshots/attendance-table.png?raw=true "Attendance Table")
![Attendance](../screenshots/adminview-attendance-details.png?raw=true "Admin View of Attendance")
![Projects](../screenshots/projects-grid.png?raw=true "Projects Card View")
![Project Details](../screenshots/project-details.png?raw=true "Project Details")
![Ticket Chat](../screenshots/ticket-chat.png?raw=true "Ticket chat")
![Payslip](../screenshots/payslip.png?raw=true "Payslip")
![Payslip Items](../screenshots/payslip-items.png?raw=true "Payslip Items")
![Chat App](../screenshots/chat-app.png?raw=true "Payslip Items")
