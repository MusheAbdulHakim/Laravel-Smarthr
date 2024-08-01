<x-table-action>
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('designations.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Designation') }}" data-size="md"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('designations.destroy', $id) }}" data-title="{{ __('Delete Designation') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
