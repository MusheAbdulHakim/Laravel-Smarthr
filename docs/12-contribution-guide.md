# Contribution Guide

Thank you for considering contributing to Laravel SmartHR!

## Getting Started

1.  **Fork the Repository** on GitHub.
2.  **Clone** your fork locally.
3.  **Install Dependencies**: `composer install` & `npm install`.
4.  **Create a Branch**:
    ```bash
    git checkout -b feature/my-new-feature
    # or
    git checkout -b fix/issue-description
    ```

## Code Standards

*   **PHP**: Follow PSR-12 coding standard.
    *   Run `pint` to auto-fix style issues:
        ```bash
        ./vendor/bin/pint
        ```
*   **Naming Conventions**:
    *   Controllers: `PascalCase` (e.g., `invoiceController` -> `InvoiceController`).
    *   Database Tables: `snake_case`, plural (e.g., `invoice_items`).
    *   Variables: `camelCase`.

## Pull Request Process

1.  **Update Documentation**: If you change behavior, update the `docs/` folder.
2.  **Add Tests**: Ensure new features have accompanying tests in `tests/Feature`.
3.  **Run Tests**:
    ```bash
    php artisan test
    ```
4.  **Commit Messages**:
    *   Use conventional commits:
        *   `feat: add new payroll calculation`
        *   `fix: resolve blank page on login`
        *   `docs: update installation steps`

## Reporting Bugs

Please use the GitHub Issue Tracker. Include:
*   Steps to reproduce.
*   Expected behavior.
*   Screenshots/Logs.
