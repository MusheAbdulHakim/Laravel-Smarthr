# Permissions Matrix

This document outlines the default permissions assigned to roles in the system.

*(Note: "Super Admin" has all permissions by default).*

## Permission Groups

permissions are grouped by module/feature area.

### User Management
| Permission | Description |
| :--- | :--- |
| `view-users` | View list of users. |
| `create-user` | Add a new user. |
| `edit-user` | Edit user details. |
| `delete-user` | Remove a user. |
| `impersonate-users` | Login as another user. |

### Employee Management
| Permission | Description |
| :--- | :--- |
| `view-employees` | View employee directory. |
| `create-employee` | Add details to an existing user. |
| `show-Employeeprofile` | View full profile. |
| `edit-employee` | Update employee data. |

### Payroll
| Permission | Description |
| :--- | :--- |
| `view-payrolls` | View generated payrolls. |
| `create-payroll` | specific payroll logic. |
| `view-payslips` | View payslips. |
| `create-payslip` | Generate a payslip. |
| `view-PayrollAllowances` | View configured allowances. |
| `view-PayrollDeductions` | View configured deductions. |

### Accounting (Invoices & Expenses)
| Permission | Description |
| :--- | :--- |
| `view-invoices` | View all invoices. |
| `create-invoice` | Create a new invoice. |
| `view-expenses` | View company expenses. |
| `create-expense` | Record an expense. |

### Projects & Operations
| Permission | Description |
| :--- | :--- |
| `view-projects` | View project list. |
| `create-project` | Start a new project. |
| `view-tickets` | View support tickets. |
| `create-ticket` | Submit a ticket. |
| `view-attendances` | View attendance logs. |

### System Settings
| Permission | Description |
| :--- | :--- |
| `view-settings` | Access global settings. |
| `view-logs` | View system activity logs. |
| `view-backups` | Download database backups. |
| `view-roles` | Manage roles. |
| `view-permissions` | Manage permissions. |

## Role Assignments (Default)

| Feature | HR | Manager | Accountant | Employee | Client |
| :--- | :---: | :---: | :---: | :---: | :---: |
| **Manage Users** | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Manage Payroll** | ✅ | ❌ | ✅ | ❌ | ❌ |
| **Create Invoices** | ❌ | ❌ | ✅ | ❌ | ❌ |
| **Manage Projects** | ❌ | ✅ | ❌ | ❌ | ❌ |
| **View Own Payslip**| ✅ | ✅ | ✅ | ✅ | ❌ |
| **Log Attendance** | ✅ | ✅ | ✅ | ✅ | ❌ |
| **View Tickets** | ✅ | ✅ | ❌ | ✅ | ✅ |

*Legend: ✅ = Has Permission, ❌ = No Permission*
