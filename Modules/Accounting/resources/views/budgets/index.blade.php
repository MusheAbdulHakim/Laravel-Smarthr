@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Budgets') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">{!! config('accounting.name') !!}</a>
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a data-url="{{ route('budgets.create') }}" href="javascript:void(0)" class="btn add-btn"
                        data-ajax-modal="true"
                        data-size="lg" data-title="{{ __('Add Budget') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Budget') }}
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
                                <th>{{ __('Title') }} </th>
                                <th>{{ __('Type') }} </th>
                                <th>{{ __('Start Date') }} </th>
                                <th>{{ __('End Date') }} </th>
                                <th>{{ __('Total Revenue') }} </th>
                                <th>{{ __('Total Expenses') }} </th>
                                <th>{{ __('Taxes') }} </th>
                                <th>{{ __('Amount') }} </th>
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
            ajax: "{{route('budgets.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'type', name: 'type'},
                {data: 'startDate', name: 'startDate'},
                {data: 'endDate', name: 'endDate'},
                {data: 'revenue', name: 'revenue'},
                {data: 'expenses', name: 'expenses'},
                {data: 'taxes', name: 'taxes'},
                {data: 'amount', name: 'amount'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-end')
            }
        })
    })
</script>
@endpush

