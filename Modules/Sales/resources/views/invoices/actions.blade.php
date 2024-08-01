<x-table-action>
    <a class="dropdown-item" href="{{ route('invoices.edit', ['invoice' => \Crypt::encrypt($id)]) }}"
        title="Edit Invoice""><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('invoices.destroy', $id) }}" data-title="{{ __('Delete Invioice') }}"
        data-question="{{ __('Are you sure you want to delete Invoice?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
