# System Diagrams

## 1. High-Level Architecture

```ascii
+-------------------+       +-------------------+       +-------------------+
|   Client Browser  | <---> |    Nginx / SSL    | <---> |   Laravel (PHP)   |
+-------------------+       +-------------------+       +-------------------+
                                                                 |
                                                                 v
                                                        +-------------------+
                                                        |  MySQL Database   |
                                                        +-------------------+
```

## 2. Module Interactions

```mermaid
graph TD
    User[User / Employee] -->|Authentication| Auth[Auth System]
    Auth --> HR[HR Core (Employees)]
    
    HR -->|Assigns| Project[Project Module]
    Project -->|Generates Tasks| Tasks[Task Board]
    
    HR -->|Logs Work| Attend[Attendance]
    Attend -->|Data for| Payroll[Payroll Module]
    
    Sales[Sales Module] -->|Invoices Client| Client
    Sales -->|Records Revenue| Accounting[Accounting Module]
    
    Accounting -->|Tracks| Budget[Budgets]
```

## 3. Database Relationships (Simplified)

```ascii
[Users] contains Credentials & Roles
   |
   +---(1:1)---> [Employee Details] contains Personal Info
   |
   +---(1:M)---> [Attendance]
   |
   +---(1:M)---> [Project Members] <---(M:1)--- [Projects]
                                                    |
                                                    +---(1:M)---> [Tasks]

[Clients] 
   |
   +---(1:M)---> [Projects]
   |
   +---(1:M)---> [Invoices]
                   |
                   +---(1:M)---> [Invoice Items]
```

## 4. Request Lifecycle

1.  **Request**: User hits `/invoices/create`.
2.  **Route**: Matches `Modules/Sales/Routes/web.php`.
3.  **Middleware**: Checks `auth` and `permission:create-invoice`.
4.  **Controller**: `InvoicesController@create` loads data (Clients, Taxes).
5.  **View**: Returns `Modules/Sales/Resources/views/create.blade.php`.
6.  **Response**: HTML rendered to browser.
