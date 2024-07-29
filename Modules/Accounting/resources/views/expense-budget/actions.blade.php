<x-table-action>
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('budget.expense.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Expense') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit Expense') }}" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('budget.expense.destroy', $id) }}" data-title="{{ __('Delete Expense') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
