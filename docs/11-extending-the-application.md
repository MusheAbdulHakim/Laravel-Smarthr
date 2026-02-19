# Extending the Application

This guide explains best practices for adding new features or modifying existing behavior in Laravel SmartHR.

## Adding a New Module

We use `nwidart/laravel-modules`. To create a new module (e.g., `Recruitment`):

1.  **Generate Module**:
    ```bash
    php artisan module:make Recruitment
    ```
    This creates `Modules/Recruitment` with controllers, routes, and views.

2.  **Register Permissions**:
    Add the new permissions to `Modules/Roles/Database/Seeders/RolesDatabaseSeeder.php` and re-seed, or create a migration to insert them into the `permissions` table.

3.  **Add Menu Item**:
    Update `app/Services/MenuService.php` to include your new module in the sidebar.

## Extending Existing Logic

### Overriding Service Logic
Most business logic resides in Service classes. To override:
1.  Create a new Service class extending the original.
2.  Bind it in `AppServiceProvider`:
    ```php
    $this->app->bind(OriginalService::class, MyCustomService::class);
    ```

### Adding Events
If you need to hook into an action (e.g., "When an invoice is created, send a Slack message"):
1.  Create a Listener: `php artisan make:listener SendSlackNotification`.
2.  Register it in `EventServiceProvider` listening for the `InvoiceCreated` event.

### Customizing Views
To customize a module's view without editing the module directly:
1.  Publish the module's views (if supported) or;
2.  Override the view path in `config/modules.php`.

## Best Practices

*   **Don't hack core files**: Try to use Events, Observers, or Service overrides.
*   **Keep Controllers Skinny**: Put logic in Services.
*   **Use Queues**: For any API call or email, use a Job.
