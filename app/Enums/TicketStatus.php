<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = "new";
    case OPEN = "open";
    case REOPEN = "reopen";
    case ONHOLD = "onhold";
    case CLOSED = "closed";
    case INPROGRESS = "inprogress";
    case CANCELLED = "cancelled";
    case COMPLETED = "completed";
}
