Build rest api -> Probably use [laravel-api](https://github.com/Froiden/laravel-rest-api)

URL

Generate .ical files when implementing the calendar module -> [iCal Generator](https://github.com/markuspoerschke/iCal)https://github.com/markuspoerschke/iCal

## Video Chat

### Calls

    -> caller_id
    -> type (Video, Audio)
    -> receiver_id
    -> sec_key
    -> call_url
    -> status (answered, missed)

    If answered:
        Link camera to camera
    else:
        add to missed calls of the receiver

-   Video call
    ->Calls::where('type', video)

## Projects

-> Add more than one employee to lead project
-> Task board
-> Task List
-> tasks

Index / Card View
->

## projects table

    ->name
    ->client / Optional
    ->startDate
    ->endDate
    ->rate
    ->rateType
    ->priority
    ->leader(employee)
    ->team(employees)
    ->longText('description')
    ->project images
    ->project files
    ->createdBy

## Task Boards

    -> default (Todo, Pending, Inprogress, OnHold, Review, Completed)

## task_boards table

    ->name
    ->color
    ->priority
    ->createdBy

## tasks table

    ->board_id
    ->name
    ->priority
    ->startDate (datetime)
    ->endDate (datetime)
    ->followers
    ->description(longText)
    ->files
    ->createdBy

## task_comments

    ->user_id
    ->task_id
    ->message

## sub_tasks

    ->parent_task_id
    ->name
    ->due_date

## bug_stages table

    ->name
    ->color
    ->priority

## Estimates

## estimates_table

    ->est_id
    ->client_id
    ->project_id
    ->tax_id
    ->client_address
    ->billing_address
    ->startDate
    ->expiryDate
    ->tax_amount
    ->discount
    ->note
    ->status


    $estimate->hasMany(EstimateItem::class);

## estimate_items_table

    ->estimate_id
    ->name
    ->description
    ->unit_cost
    ->quantity
    ->total

    $estimateItem->belongsTo(Estimate::class)

## Invoices

### invoices_table

    ->inv_id
    ->client_id
    ->project_Id default: null
    ->tax_id
    ->client_address
    ->billing_address
    ->startDate
    ->dueDate
    ->tax_amount
    ->discount
    ->note
    ->status

### InvoiceItem

    ->invoice_id
    ->name
    ->description
    ->unit_cost
    ->quantity
    ->total
