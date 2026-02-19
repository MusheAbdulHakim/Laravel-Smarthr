# Human Resources (Core)

While not a standalone "Module" in the `Modules/` directory, the HR features are the core of the application found in `app/`.

## Employee Management

### Models
*   `User`: The login account.
*   `EmployeeDetail`: The HR profile.
*   `Department`, `Designation`: Structural metadata.

### Features
*   **Profile**: Personal info, Emergency contacts, Bank details.
*   **Education & Experience**: Resume-like data tracking.
*   **Documents**: Storage for contracts, IDs, etc.

### Routes
*   `/employees`: List and management.
*   `/employee/personal-info/{id}`: Detail view.

## Attendance

### Models
*   `Attendance`: Records `clock_in`, `clock_out`, `lat/long`.

### Workflow
1.  **Clock In**: Employee clicks "Clock In" on dashboard.
2.  **Tracking**: System records time and IP/Location.
3.  **Clock Out**: Employee ends day.
4.  **Reporting**: HR views monthly attendance reports.

## Tickets (Support)

Internal helpdesk system.

### Models
*   `Ticket`: The query.
*   `TicketFiles`: Attachments.
*   `TicketReply`: Conversation.

### Workflow
1.  Employee raises ticket (e.g., "Laptop issue").
2.  Admin/IT receives notification.
3.  Admin replies/assigns status.
4.  Ticket closed.
