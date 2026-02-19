# Architecture Deep Dive

Laravel SmartHR uses a **Modular Monolith** architecture based on the `nwidart/laravel-modules` package. This approach allows us to separate business domains (Accounting, Sales, Projects) into their own directories with dedicated routes, controllers, and models, while still sharing the core application infrastructure.

## Application Layers

The application is structured into the following layers:

### 1. The Core Application (`app/`)
The `app/` directory contains the core domain logic that is shared across the entire system or doesn't fit into a specific module.
*   **Models**: Core entities like `User`, `EmployeeDetail`, `Department`, `Designation`.
*   **Http**: Core middleware, authentication controllers (`Admin\*`), and base controllers.
*   **Services**: Shared services like `MenuService` for dynamic navigation.

### 2. Modules (`Modules/`)
Each major feature set is basically a mini-Laravel application inside the `Modules/` directory.

Example structure of a module (e.g., `Modules/Accounting`):
```text
Modules/Accounting/
├── Config/             # Module-specific configuration
├── Console/            # Console commands
├── Database/           # Migrations and Seeders
├── Http/               # Controllers, Middleware, Requests
├── Models/             # Module-specific Eloquent models (e.g., Invoice, Expense)
├── Providers/          # Service Providers
├── Resources/          # Views and Assets
├── Routes/             # Web and API routes
└── Tests/              # Module-specific tests
```

### 3. Service Layer Pattern
We encourage a Service layer pattern to keep controllers slim.
*   **Controllers**: Handle HTTP requests, validation, and return responses. They should not contain complex business logic.
*   **Services**: Contain the actual business logic. (e.g., `PayrollService` to calculate taxes and net salary).

## Request Lifecycle

1.  **Route Model Binding**: Laravel automatically resolves module parameters (like `{invoice}`) to their respective Models.
2.  **Middleware**:
    *   `auth`: Ensures user is logged in.
    *   `permission:view-X`: Spatie permission middleware checks if the user has the required permission (e.g., `view-invoices`) before accessing the controller.
3.  **Controller Action**: The controller receives the request.
4.  **Service Invocation**: The controller calls a Service or Model method to perform the action.
5.  **Event Dispatching**: Significant actions (like `InvoicePaid`) dispatch Laravel Events.
6.  **Response**: The controller returns a Blade view or a JSON response.

## Database Interaction

*   **Eloquent ORM**: Used for almost all database interactions.
*   **Relationships**:
    *   **Core-to-Module**: `User` (Core) has many `Ticket` (Core) or `Invoice` (Accounting Module).
    *   **Module-to-Module**: Relationships between modules should be loose, often linked by `user_id` or `client_id` integers rather than hard foreign key constraints if possible, though strict keys are used where data integrity is paramount.

## Authentication & Authorization

*   **Authentication**: Standard Laravel Session-based auth.
*   **Authorization**: `spatie/laravel-permission`.
    *   **Roles**: Define a set of permissions (e.g., "Accountant").
    *   **Permissions**: Granular actions (e.g., `create-invoice`, `delete-employee`).
    *   **Policy Enforcements**: Checked in Routes (via middleware) and Blade Views (via `@can` directives).

## Event System

The system uses standard Laravel Events and Listeners to decouple logic.

*   **Example**: When a Ticket is replied to (`TicketReplied` event), a Listener sends a notification to the user.
*   **Location**:
    *   Core Events: `app/Events`
    *   Data/Model Events: Defined in Model `booted` methods or Observers.

## Extending the Architecture

When adding a new feature:
1.  **Is it a core HR function?** Add to `app/`.
2.  **Is it a distinct business domain?** Create a new Module using `php artisan module:make <ModuleName>`.
