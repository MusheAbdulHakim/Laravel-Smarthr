@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Invoices') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">{!! config('sales.name') !!}</a>
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a href="{{ route('invoices.create') }}" class="btn add-btn" data-bs-toggle="tooltip" title="Create Invoice">
                        <i class="fa-solid fa-plus"></i> {{ __('Create Invoice') }}
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
                                <th>{{ __('Invoice Number') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Invoice Date') }}</th>
                                <th>{{ __('Due Date') }}</th>
                                <th>{{ __('Grand Total') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date Created') }}</th>
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
            ajax: "{{route('invoices.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'inv_id', name: 'inv_id'},
                {data: 'client', name: 'client'},
                {data: 'start_date', name: 'start_date'},
                {data: 'due_date', name: 'due_date'},
                {data: 'grand_total', name: 'grand_total'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-end')
            }
        })
    })
</script>
@endpush