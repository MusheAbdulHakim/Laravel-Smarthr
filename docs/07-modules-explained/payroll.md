# Payroll System

The Payroll system is a core feature designed to automate salary generation.

## Models

*   `Payroll`: A generated salary record for a month.
*   `Payslip`: The printable document.
*   `EmployeeSalaryDetail`: Defines the basis (Basic Salary, Hourly Rate).
*   `EmployeeAllowance`: Recurring additions (Housing, Transport).
*   `EmployeeDeduction`: Recurring subtractions (Tax, Insurance).

## Payroll Calculation Logic

The system generally follows this formula:

```
Net Salary = (Basic Salary + Total Allowances) - (Total Deductions + Tax + Unpaid Leave Deductions)
```

## Workflow

1.  **Setup**: HR configures allowances and deductions for an employee.
2.  **Salary Settings**: Define the basic salary.
3.  **Generate**: At month-end, HR runs the payroll generation process.
    *   System checks attendance (if linked).
    *   Calculates final amount.
4.  **Distribution**: Payslips are generated and made available to employees.

## Routes

*   `/payroll/items`: Configure global items.
*   `/payroll/payslips`: Generate and view slips.
