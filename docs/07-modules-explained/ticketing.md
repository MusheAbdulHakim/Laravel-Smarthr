# Ticketing System

The Ticketing system serves as an internal help desk for employees to raise issues (IT, HR, Admin).

## Overview

Employees can create tickets which are routed to the Admin team. The communication happens via a threaded reply system.

## Key Features

*   **Ticket Creation**: Employees raise tickets with Subjects, Priority, and Description.
*   **Ticket Assignment**: Admins can assign other agents to tickets.
*   **Replies**: Threaded conversation.
*   **Status Management**: Open, Pending, Resolved, Closed.
*   **Attachments**: File uploads for context.

## Models & Database

| Model | Table | Description |
| :--- | :--- | :--- |
| `Ticket` | `tickets` | Main ticket record. |
| `TicketReply` | `ticket_replies` | Conversations. |
| `TicketFile` | `ticket_files` | Attachments. |

## Workflow

1.  **Issue Raised**: User creates ticket. Status: `Open`.
2.  **Triage**: Admin reviews ticket, sets Priority (High/Medium/Low).
3.  **Resolution**: Admin replies.
4.  **Closure**: User or Admin marks as `Resolved`.

## Routes

Prefix: `/tickets`

| Method | URI | Description |
| :--- | :--- | :--- |
| RESOURCE | `/tickets` | CRUD for Tickets. |
| GET | `/assigned-tickets` | Tickets assigned to the logged-in user. |
| POST | `/assign-ticket` | Admin assigns a user to a ticket. |
