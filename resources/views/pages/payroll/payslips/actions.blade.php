<x-table-action>
    @can('edit-payslip')
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('payslips.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Payslip') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit Payslip') }}" data-size="md"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    @endcan
    @can('show-payslip')
    <a class="dropdown-item" href="{{ route('payslips.show', ['payslip' => \Crypt::encrypt($id)]) }}" 
        data-title="{{ __('View Payslip') }}" data-bs-toggle="tooltip"><i class="fa-solid fa-eye m-r-5"></i>
        {{ __('View') }}
    </a>
    @endcan
    @can('delete-payslip')
    <a class="dropdown-item deleteBtn" data-route="{{ route('payslips.destroy', $id) }}" data-title="{{ __('Delete Payslip') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
    @endcan
</x-table-action>
