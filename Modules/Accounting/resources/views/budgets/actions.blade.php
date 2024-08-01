<x-table-action>
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('budgets.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Budget') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit Budget') }}" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('budgets.destroy', $id) }}" data-title="{{ __('Delete Budget') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
