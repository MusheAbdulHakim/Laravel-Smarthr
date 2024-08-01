<div>
    <h5>{{ __('Subject') }}: {{ $ticket->subject }}</h5>

    <p>{{ __('Created At: ') }}: {{ format_date($ticket->created_at) }}</p>
    <p>{{ __('Created By: ') }}: {{ $ticket->createdBy->fullname }}</p>
    @if (!empty($ticket->status))
    <p>{{ __('Status: ') }}: {{ $ticket->status->name }}</p> 
    @endif
    @if (!empty($ticket->priority))
    <p>{{ __('Priority: ') }}: {{ $ticket->priority->name }}</p>  
    @endif
    <p>
        <strong>{{ __('Description') }}: </strong>
    </p>
    <div>
        {!! $ticket->description !!}
    </div>
    <x-mail::button :url="$url" color="primary">
        {{ __('View Ticket') }}
    </x-mail::button>
</div>
