@extends('layouts.app')

@section('page-content')
<div class="content container-fluid">
    <!-- Page Header -->
    <x-breadcrumb class="col">
        <x-slot name="title">{{ $project->name }}</x-slot>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="#">{{ __('Projects') }}</a>
            </li>
        </ul>
        <x-slot name="right">
            <div class="col-auto float-end ms-auto">
                <div class="view-icons">
                    <a href="{{ route('project.taskboard',['id' => \Crypt::encrypt($project->id)]) }}" class="grid-view btn btn-link p-2 text-decoration-none" data-bs-toggle="tooltip" title="{{ __('Task Board') }}"><i class="fa fa-th"></i> {{ __('Task Board') }}</a>
                    <a href="{{ route('projects.index') }}" class="grid-view btn btn-link" data-bs-toggle="tooltip" title="{{ __('Projects Grid View') }}"><i class="fa fa-th"></i></a>
                    <a href="{{ route('projects.list') }}" class="list-view btn btn-link" data-bs-toggle="tooltip" title="{{ __('Projects List View') }}"><i class="fa-solid fa-bars"></i></a>
                    <a href="javascript:void(0)" data-url="{{ route('projects.edit', ['project' => ($project->id)]) }}" data-ajax-modal="true"
                        data-title="Edit Project" data-size="lg" class="list-view btn btn-link" data-bs-toggle="tooltip" title="{{ __('Edit Project') }}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a data-route="{{ route('projects.destroy', $project->id) }}" data-title="Delete Project" class="list-view btn btn-link deleteBtn"
                        data-question="Are you sure you want to delete project?" href="javascript:void(0)" data-bs-toggle="tooltip" title="{{ __('Delete Project') }}">
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>
            </div>
        </x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="project-title">
                        <h5 class="card-title">{{ __('Brief Description') }}</h5>
                        <small class="block text-ellipsis m-b-15"><span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> 
                            <span class="text-muted">{{ __('Opened Tasks') }}, </span>
                            <span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> <span class="text-muted">{{ __('Tasks Completed') }}</span>
                        </small>
                        <p>{{ $project->short_desc }}</p>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-20">{{ __('Full Description') }}</h5>
                    <div class="row">
                        <div class="col-12">
                            {!! $project->description !!}
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($projectFiles) && $projectFiles->count() > 0)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-20">{{ __('Uploaded files') }}</h5>
                    <ul class="files-list">
                        @foreach ($projectFiles as $file) 
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon">
                                        @switch($file->mime_type)
                                            @case('application/pdf')
                                                <i class="fa-regular fa-file-pdf"></i>
                                                @break
                                            @case('image/jpeg' || 'image/png' || 'image/jpg')
                                                <i class="fa-regular fa-file-pdf"></i>
                                                @break
                                            @default
                                            <i class="fa-regular fa-file-file"></i>
                                        @endswitch
                                    </span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a target="_blank" href="{{ $file->getFullUrl() }}">{{ $file->file_name }}</a></span>
                                    <span class="file-date">{{ __('Date') }}: {{ format_date($file->created_at) }}</span>
                                    <div class="file-size">{{ __('Size') }}: {{ format_file_size($file->size) }}</div>
                                </div>
                                <ul class="files-action">
                                    <li class="dropdown dropdown-action">
                                        <a href="#" class="dropdown-toggle btn btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ $file->getFullUrl() }}" download="">{{ __('Download') }}</a>
                                            <a class="dropdown-item deleteBtn" href="javascript:void(0)" data-route="{{ route('project-file.destroy', $file->id) }}" data-title="Delete Project File"
                                                data-question="Are you sure you want to delete project file?">{{ __('Delete') }}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div> 
            @endif
            
        </div>
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title m-b-15">{{ __('Project details') }}</h6>
                    <table class="table table-striped table-border">
                        <tbody>
                            <tr>
                                <td>{{ __('Cost') }}:</td>
                                <td class="text-end">
                                    {{-- todo: implement calculation of cost base on hourly pricing --}}
                                    {{ LocaleSettings('currency_symbol')}} {{ ($project->rateType == 'Fixed') ? $project->rate: ($project->rate)  }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Created') }}:</td>
                                <td class="text-end">{{ format_date($project->created_at) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Date Started') }}:</td>
                                <td class="text-end">{{ format_date($project->startDate) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Deadline') }}:</td>
                                <td class="text-end">{{ format_date($project->endDate) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Priority') }}:</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        @switch($project->priority)
                                            @case('High')
                                                <a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> {{ __('Highest priority') }}</a>
                                            @break
                                            @case('Medium')
                                                <a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-info"></i>{{__('Medium priority')}}</a>
                                                @break
                                            @case('Normal')
                                                <a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-primary"></i> {{ __('Normal priority') }}</a>
                                                @break
                                            @case('Low')
                                                <a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> {{ __('Low priority') }}</a>
                                                @break
                                            @default
                                            <a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> {{ __('Low priority') }}</a>
                                        @endswitch    
                                    </div>
                                </td>
                               
                            </tr>
                            <tr>
                                <td>{{ __('Created by') }}:</td>
                                <td class="text-end"><a href="#">{{ $project->createdBy->fullname }}</a></td>
                            </tr>
                            @if (!empty($project->status))
                            <tr>
                                <td>{{ __('Status') }}:</td>
                                <td class="text-end">{{ $project->status }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="card project-user">
                <div class="card-body">
                    <h6 class="card-title m-b-20">{{ __('Project Leader') }} 
                    </h6>
                    <ul class="list-box">
                        <li>
                            <a href="@can('show-Employeeprofile') {{ route('employees.show', ['employee' => \Crypt::encrypt($project->leader_id)]) }} @else # @endcan">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar"><img src="{{ !empty($project->leader->avatar) ? uploadedAsset($project->leader->avatar,'users'): asset('images/user.jpg') }}" alt="{{ __('avatar') }}"></span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">{{ $project->leader->fullname }}</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">{{ __('Team Leader') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @php
                $projectTeam = $project->team;
            @endphp
            @if (!empty($projectTeam) && $projectTeam->count())    
            <div class="card project-user">
                <div class="card-body">
                    <h6 class="card-title m-b-20">
                        {{ __('Assigned Team') }}
                    </h6>
                    <ul class="list-box">  
                        @foreach ($projectTeam->take(4) as $member)
                        <li>
                            <a href="profile.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">
                                            <img src="{{ !empty($member->user->avatar) ? uploadedAsset($member->user->avatar,'users'): asset('images/user.jpg') }}" alt="{{ $member->user->fullname.' avatar' }}">
                                        </span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">{{ $member->user->fullname }}</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">{{ $member->user->employeeDetail->designation->name ?? '' }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
    <!-- Page Js -->
    @vite([
        "resources/assets/css/ckeditor.css",
        "resources/js/ckeditor.js"
    ])
    <!-- /Page Js -->
@endpush
