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
    This can be done either via config file (core app) or Event Listener (modules).

## Adding Menu Items

Laravel SmartHR has two sidebars:
- **Main Sidebar**: The primary application navigation
- **Settings Sidebar**: Context-aware settings navigation

### Method 1: Config File (Main Sidebar)

For core app menu items, add to `config/menu.php`:

```php
return [
    [
        'title' => 'Section Title',     // Optional: Group title
        'label' => 'Menu Label',   // Required: Display text
        'route' => 'route.name', // Required: Named route
        'icon' => 'icon-name',   // Optional: Icon class
        'order' => 10,          // Optional: Display order (1-100)
        'permission' => 'permission-name', // Optional: Single permission
        'permissions' => ['perm1', 'perm2'], // Optional: Multiple (any grants access)
    ],
    [
        // Dropdown menu with sub-items
        'label' => 'Dropdown',
        'icon' => 'folder',
        'order' => 20,
        'items' => [
            ['label' => 'Sub Item 1', 'route' => 'item1.index'],
            ['label' => 'Sub Item 2', 'route' => 'item2.index'],
        ],
    ],
];
```

**Menu Item Properties:**

| Property | Type | Description |
|----------|------|-------------|
| `label` | string | Display text (use `__()` for translation) |
| `route` | string | Named route name |
| `icon` | string | Icon class (e.g., 'user', 'cog') |
| `order` | int | Sort order (lower = higher) |
| `permission` | string | Single permission required |
| `permissions` | array | Multiple permissions (any grants access) |
| `title` | string | Section header text |
| `items` | array | Sub-menu items (creates dropdown) |

### Method 2: Event Listener (Modules)

Modules add menu items via `AppMenuEvent` listener. This allows dynamic permission checking.

1.  **Create Listener**:
    ```bash
    php artisan make:listener ProjectAppMenuListener
    ```

2.  **Register in EventServiceProvider**:
    ```php
    // Modules/Project/app/Providers/EventServiceProvider.php
    protected $listen = [
        AppMenuEvent::class => [
            ProjectAppMenuListener::class,
        ],
    ];
    ```

3.  **Implement Listener**:
    ```php
    // Modules/Project/app/Listeners/ProjectAppMenuListener.php
    public function handle(AppMenuEvent $event): void
    {
        if (auth()->user()->canAny(['view-projects', 'view-taskboards'])) {
            $event->menu->add([
                'label' => __('Projects'),
                'icon' => 'rocket',
                'permissions' => ['view-projects', 'view-taskboards'],
                'order' => 13,
                'items' => [
                    [
                        'label' => __('Projects'),
                        'route' => 'projects.index',
                        'permission' => 'view-projects',
                    ],
                    [
                        'label' => __('TaskBoards'),
                        'route' => 'task-boards.index',
                        'permission' => 'view-taskboards',
                    ],
                ],
            ]);
        }
    }
    ```

### Adding Settings Menu Items

The Settings Sidebar is context-aware. Add items via `AppSettingsMenuEvent`:

```php
// Modules/YourModule/app/Providers/EventServiceProvider.php
protected $listen = [
    AppSettingsMenuEvent::class => [
        YourModuleSettingsMenuListener::class,
    ],
];
```

```php
// YourModuleSettingsMenuListener.php
public function handle(AppSettingsMenuEvent $event): void
{
    $event->menu->addSettingsMenu([
        'label' => __('Your Settings'),
        'route' => 'yourmodule.settings',
        'icon' => 'cog',
        'order' => 10,
    ]);
}
```

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
*   **Use Translation**: Always use `__()` for menu labels for internationalization.
*   **Check Permissions**: Use the permission system for access control. Do not hard-code role checks.