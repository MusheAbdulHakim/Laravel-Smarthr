@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-breadcrumb class="col">
        <x-slot name="title">{{ __('Task Board') }}</x-slot>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">
                {{ __('Task Boards') }}
            </li>
        </ul>
        <x-slot name="right">
            <div class="col-auto float-end ms-auto">
                <a data-url="{{ route('task-boards.create') }}" href="javascript:void(0)" class="btn add-btn"
                    data-ajax-modal="true"
                    data-size="md" data-title="Add Task Board">
                    <i class="fa-solid fa-plus"></i> {{ __('Add Board') }}
                </a>
            </div>
        </x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped custom-table w-100">
                            <thead>
                                <tr class="text-center">
                                    <th><i class="fa-solid fa-crosshairs"></i></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Color') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boards as $item)
                                    <tr class="text-center">
                                        <td><i class="fa-solid fa-crosshairs"></i></td>
                                        <td>{{ $item->name }}</td>
                                        <td><input type="color" value="{{ $item->color }}" disabled></td>
                                        <td>
                                            <a href="javascript:void(0)" data-url="{{ route('task-boards.edit', $item->id) }}" data-ajax-modal="true"
                                                data-title="{{ __('Edit Task Board') }}" data-size="md"><i class="fa-solid fa-pencil"></i>
                                                {{ __('Edit') }}
                                            </a>

                                            <a class="deleteBtn ms-2" data-route="{{ route('task-boards.destroy', $item->id) }}" data-title="{{ __('Delete Task Board') }}"
                                                data-question="{{ __('Are you sure you want to delete taskboard?') }}" href="javascript:void(0)">
                                                <i class="fa-regular fa-trash-can"></i>{{ __('Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->

    <!-- /Page Js -->
@endpush
