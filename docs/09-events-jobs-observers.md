# Events, Jobs, and Observers

This document details the asynchronous behaviors and event-driven architecture of the system.

## Events

Events are located in `app/Events`. They serve to decouple the immediate action from side effects (like notifications).

| Event | Fired When | Payload |
| :--- | :--- | :--- |
| `TicketReplied` | Admin or User replies to a ticket. | `TicketReply $reply` |
| `ChatMessageSent` | A chat message is sent. | `ChatMessage $message` |
| `AppMenuEvent` | Dynamic menu is being built. | `Menu $menu` |

### Listeners

Listeners (in `app/Listeners`) handle these events.

*   **TicketReplied** -> `SendTicketReplyNotification`: Queues an email to the other party.

## Jobs (Queues)

Jobs are located in `app/Jobs`. They handle long-running tasks in the background.

| Job | Description | Frequency |
| :--- | :--- | :--- |
| `SendHolidayNotifications` | Checks for upcoming holidays and notifies users. | Daily (via Schedule) |
| `AutoClockoutUnsignedAttendances` | Checks for employees who forgot to clock out. | Daily (Midnight) |

### Running the Queue
Ensure your queue worker is running:
```bash
php artisan queue:work --tries=3
```

## Observers

Observers monitor Eloquent Model lifecycle events (Create, Update, Delete).

*(Note: If no explicit Observers directory exists, check `AppServiceProvider` or Model `booted` methods for closure-based model events).*

### Common Model Events
*   **User Linking**: When a `User` is created, an associated `EmployeeDetail` record is often initialized (handled in `UserSeeder` or Controller logic).
