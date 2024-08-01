<x-table-action>
    @can('edit-ticket')
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('tickets.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Ticket') }}" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    @endcan
    @can('delete-ticket')
    <a class="dropdown-item deleteBtn" data-route="{{ route('tickets.destroy', $id) }}" data-title="{{ __('Delete Ticket') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
    @endcan
</x-table-action>
