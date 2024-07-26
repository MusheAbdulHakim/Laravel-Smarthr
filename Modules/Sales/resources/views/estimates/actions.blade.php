<x-table-action>
    <a class="dropdown-item" href="{{ route('estimates.edit', ['estimate' => \Crypt::encrypt($id)]) }}"
        title="Edit Estimate""><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('estimates.destroy', $id) }}" data-title="Delete Estimate"
        data-question="Are you sure you want to delete Estimate?" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
