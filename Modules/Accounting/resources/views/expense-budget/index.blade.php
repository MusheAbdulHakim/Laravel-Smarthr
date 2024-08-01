@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Budget Expenses') }}</x-slot>
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
                    <a data-url="{{ route('budget.expense.create') }}" href="javascript:void(0)" class="btn add-btn"
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
                                <th>{{ __('Title') }} </th>
                                <th>{{ __('Category') }} </th>
                                <th>{{ __('Amount') }} </th>
                                <th>{{ __('Start Date') }} </th>
                                <th>{{ __('End Date') }} </th>
                                <th>{{ __('Note') }} </th>
                                <th>{{ __('Attachment') }} </th>
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
            ajax: "{{route('budget.expense.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'category', name: 'category'},
                {data: 'amount', name: 'amount'},
                {data: 'startDate', name: 'startDate'},
                {data: 'endDate', name: 'endDate'},
                {data: 'note', name: 'note'},
                {data: 'attachment', name: 'attachment'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-end')
            }
        })
    })
</script>
@endpush

