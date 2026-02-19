# Accounting Module

The Accounting module handles the internal financial tracking of the organization, focusing on budgets.

## Overview

This module allows the organization to set financial budgets, track expenses against those budgets, and monitor revenue targets.

> **Note:** Client-facing financial documents like Invoices and Estimates are handled in the **Sales** module.

## Key Features

*   **Budget Categories**: Organize financial data (e.g., "Marketing", "Operations").
*   **Overall Budgets**: Set total budget limits.
*   **Revenue Budgets**: Track expected income.
*   **Expense Budgets**: Track allowed spending.

## Models & Database

| Model | Table | Description |
| :--- | :--- | :--- |
| `BudgetCategory` | `budget_categories` | Categories for budgets. |
| `Budget` | `budgets` | Main budget records. |
| `RevenueBudget` | `revenue_budgets` | Linked to categories. |
| `ExpenseBudget` | `expense_budgets` | Linked to categories. |

## Workflow

1.  **Define Categories**: Admin creates categories like "Travel", "Salaries".
2.  **Set Budget**: Admin defines a budget for a period.
3.  **Monitor**: Expenses recorded in the Sales module or Payroll module should theoretically link here (check integration).

## Routes

Prefix: `/accounting`

| Method | URI | Controller |
| :--- | :--- | :--- |
| GET | `/accounting/budgets` | `BudgetsController@index` |
| POST | `/accounting/budgets` | `BudgetsController@store` |
| GET | `/accounting/budget-categories` | `BudgetCategoriesController@index` |
