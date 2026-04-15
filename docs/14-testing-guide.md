# Testing Guide

We use **Pest/PHPUnit** for automated testing.

## Running Tests

Run the full suite:
```bash
php artisan test
```

Run a specific file:
```bash
php artisan test tests/Feature/AuthenticationTest.php
```

## Writing Tests

Tests are located in `tests/`.

*   **Feature Tests**: Test HTTP endpoints, database changes, and full flows.
    *   Example: "User can login", "Invoice is created".
*   **Unit Tests**: Test isolated methods (e.g., Salary calculation logic).

### Example Test (Pest)

```php
test('user can view dashboard', function () {
    $user = User::factory()->create();

    $response = this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});
```

## Continuous Integration (CI)

We verify tests on every Pull Request via GitHub Actions. Ensure your tests pass locally before pushing.
