# Database Schema Documentation

The application's database is structured around core HR entities and extended by modular tables.

## Core Tables

These tables handle the fundamental users and HR data.

### Users & Authentication
*   `users`: Stores login credentials, roles, and basic profile info.
*   `password_reset_tokens`: Stores password reset tokens.
*   `sessions`: (If using database driver) Stores active sessions.
*   `personal_access_tokens`: Stores API tokens (Sanctum).

### Employee Management
*   `employee_details`: Detailed employee info (DOB, nationality, contact). Linked to `users`.
*   `departments`: Organizational departments (e.g., "Engineering").
*   `designations`: Job titles (e.g., "Senior Developer").
*   `employee_education`: Academic qualifications.
*   `employee_work_experiences`: Previous employment history.
*   `employee_documents`: Uploaded files (ID cards, contracts).
*   `family_infos`: Spouse/children details.
*   `emergency_contacts`: Emergency contact details.

### Attendance & Leave
*   `attendances`: Daily attendance records (clock-in/out).
*   `holidays`: Public holidays and weekends.
*   `leaves`: Leave requests and balances (if implemented in core).

### Payroll
*   `payrolls`: Main payroll records per month.
*   `payslips`: Generated pay slips linked to payroll.
*   `allowances`: Configurable allowances (HRA, Transport).
*   `deductions`: Configurable deductions (Tax, Insurance).
*   `employee_salary_details`: Base salary and structure per employee.

### Tickets (Support)
*   `tickets`: Internal support tickets.
*   `ticket_replies`: Conversation history for tickets.

### Assets
*   `assets`: Company assets (Laptops, Phones).
*   `asset_issues`: Records of assets assigned to employees.

## Module Tables

### Accounting Module
*   `invoices`: Client invoices.
*   `invoice_items`: Line items for invoices.
*   `expenses`: Company expenses.
*   `budgets`: Financial budgets.
*   `taxes`: Tax rates.

### Project Module
*   `projects`: Client projects.
*   `tasks`: Tasks within projects.
*   `project_members`: Users assigned to projects.
*   `task_boards`: KanBan board columns.

### Sales Module
*   `estimates`: Cost estimates for clients.
*   `leads`: Potential clients.

## Key Relationships

*   **User -> EmployeeDetail**: One-to-One.
*   **Department -> EmployeeDetail**: One-to-Many.
*   **User -> Ticket**: One-to-Many (Creator).
*   **Project -> Task**: One-to-Many.
*   **Invoice -> Client**: Many-to-One.

## Pivot Tables
Pivot tables are used for many-to-many relationships, though less common in this specific schema compared to direct foreign keys.
*   `role_has_permissions`: (Spatie) Links roles to permissions.
*   `model_has_roles`: (Spatie) Links users to roles.
*   `project_members`: Links users to projects.
