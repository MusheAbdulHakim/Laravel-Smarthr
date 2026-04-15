# Authentication & Authorization

Laravel SmartHR uses a robust authentication and authorization system.

## Authentication

Authentication is handled by Laravel's built-in authentication services (`Illumninate\Auth`).

*   **Guard**: `web` (Session-based) is the default guard.
*   **Provider**: `users` (Eloquent User model).
*   **Login Controller**: `App\Http\Controllers\Auth\LoginController`.

### User Types
The `users` table has a `type` column (handled by `UserType` Enum):
1.  `superadmin`: Has access to everything.
2.  `employee`: Standard user.
3.  `client`: Client user (restricted to their projects/invoices).

## Authorization (RBAC)

We use the `spatie/laravel-permission` package for Role-Based Access Control.

### Roles
Roles are defined in the `roles` table. Standard roles include:
*   **Super Admin**: Bypass all permission checks using `Gate::before`.
*   **HR**: Can manage employees, payroll, and attendance.
*   **Manager**: Can manage projects and their team's tasks.
*   **Employee**: Can view own data and basic features.
*   **Client**: Can view project progress and billing.
*   **Accountant**: Can manage invoices and expenses.

### Permissions
Permissions are granular access rights (e.g., `create-employee`, `view-invoices`).
They are assigned to **Roles**, not directly to users (mostly).

### Checking Permissions in Code

#### In Blade Views
```blade
@can('create-employee')
    <button>Add Employee</button>
@endcan
```

#### In Controllers
```php
public function store(Request $request)
{
    $this->authorize('create-employee');
    // ... logic
}
```

#### In Routes
```php
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('permission:view-employees');
```

## Middleware

The application uses standard middleware for protection:
*   `auth`: Redirects unauthenticated users to login.
*   `role:{role_name}`: Restricts access to specific role.
*   `permission:{permission_name}`: Restricts access to specific permission.
