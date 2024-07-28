@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Expenses') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Expenses') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a data-url="{{ route('expenses.create') }}" href="javascript:void(0)" class="btn add-btn"
                        data-ajax-modal="true"
                        data-size="lg" data-title="{{ __('Add Expense') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Expense') }}
                    </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Item') }} </th>
                                <th>{{ __('Purchase From') }} </th>
                                <th>{{ __('Purchase Date') }} </th>
                                <th>{{ __('Amount') }} </th>
                                <th>{{ __('Paid By') }} </th>
                                <th>{{ __('Status') }}</th>
                                <th class="text-end">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
@vite([
    "resources/js/datatables.js"
])
<script type="module">
    $(document).ready(function(){
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('expenses.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'item_name', name: 'item_name'},
                {data: 'purchased_from', name: 'purchased_from'},
                {data: 'purchase_date', name: 'purchase_date'},
                {data: 'amount', name: 'amount'},
                {data: 'paid_by', name: 'paid_by'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-end')
            }
        })
    })
</script>
@endpush

