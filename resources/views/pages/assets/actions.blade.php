<x-table-action>
    <a class="dropdown-item" href="{{ route('assets.show', $id) }}"><i class="fa-solid fa-eye m-r-5"></i>
        {{ __('View') }}
    </a>
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('assets.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Asset') }}" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    <a class="dropdown-item deleteBtn" data-route="{{ route('assets.destroy', $id) }}" data-title="{{ __('Delete Asset') }}"
        data-question="{{ __('Are you sure you want to delete asset?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
</x-table-action>
