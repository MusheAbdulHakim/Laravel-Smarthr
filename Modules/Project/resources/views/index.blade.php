@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Projects') }}</x-slot>
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
                    <a href="javascript:void(0)" data-url="{{ route('projects.create') }}" class="btn add-btn"
                        data-ajax-modal="true" data-size="lg" data-title="Add Project">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Project') }}
                    </a>
                    <div class="view-icons">
                        <a href="{{ route('projects.index') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="{{ route('projects.list') }}" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                    </div>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
           @if (!empty($projects) && $projects->count() > 0)
            @foreach ($projects as $project)
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="dropdown dropdown-action profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('projects.edit', ['project' => ($project->id)]) }}" data-ajax-modal="true"
                                    data-title="Edit Project" data-size="lg">
                                    <i class="fa-solid fa-pencil m-r-5"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a class="dropdown-item deleteBtn" data-route="{{ route('projects.destroy', $project->id) }}" data-title="Delete Project"
                                    data-question="Are you sure you want to delete project?" href="javascript:void(0)">
                                    <i class="fa-regular fa-trash-can m-r-5"></i>
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </div>
                        <h4 class="project-title">
                            <a href="{{ route('projects.show', ['project' => \Crypt::encrypt($project->id)]) }}">{{ $project->name }}</a>
                        </h4>
                        <small class="block text-ellipsis m-b-15">
                            <span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> <span class="text-muted">{{ __('Opened Tasks') }}</span>
                            <span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> <span class="text-muted">{{ __('Tasks Completed') }}</span>
                        </small>
                        <p class="text-muted">
                            {{$project->short_desc}}
                        </p>
                        <div class="d-flex justify-content-between">
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    {{ __('Start Date') }}:
                                </div>
                                <div class="text-muted">
                                    {{ format_date($project->startDate) }}
                                </div>
                            </div>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    {{ __('Deadline') }}:
                                </div>
                                <div class="text-muted">
                                    {{ format_date($project->endDate) }}
                                </div>
                            </div>
                        </div>
                        <div class="project-members m-b-15">
                            <div>{{ __('Project Leader') }} :</div>
                            <ul class="team-members">
                                @if (!empty($project->leader_id))     
                                <li>
                                    <a href="@can('show-Employeeprofile') {{ route('employees.show', ['employee' => \Crypt::encrypt($project->leader_id)]) }} @else # @endcan" data-bs-toggle="tooltip" title="{{ $project->leader->fullname }}">
                                        <img src="{{ !empty($project->leader->avatar) ? uploadedAsset($project->leader->avatar,'users'): asset('images/user.jpg') }}" alt="{{ __('Avatar') }}">
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @php
                            $projectTeam = $project->team;
                        @endphp
                        @if (!empty($projectTeam) && $projectTeam->count() > 0)  
                        <div class="project-members m-b-15">
                            <div>{{ __('Team') }} :</div>
                            <ul class="team-members">
                                @foreach ($projectTeam->take(4) as $member)
                                <li>
                                    <a href="@can('show-Employeeprofile') {{ route('employees.show', ['employee' => \Crypt::encrypt($member->user->id)]) }} @else # @endcan" data-bs-toggle="tooltip" title="{{ $member->user->fullname }}">
                                        <img src="{{ !empty($member->user->avatar) ? uploadedAsset($member->user->avatar,'users'): asset('images/user.jpg') }}" alt="{{ __('Avatar') }}">
                                    </a>
                                </li>
                                @endforeach
                                @if (!empty($projectTeam) && $projectTeam->count() > 4)    
                                <li class="dropdown avatar-dropdown">
                                    <a href="#" class="all-users dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ !empty($projectTeam) && $projectTeam->count() > 0 ? ($projectTeam->count() - 4): '' }}</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="avatar-group">
                                            @foreach ($projectTeam as $member)
                                            <a class="avatar avatar-xs" data-bs-toggle="tooltip" title="{{ $member->user->fullname }}" href="@can('show-Employeeprofile') {{ route('employees.show', ['employee' => \Crypt::encrypt($member->user->id)]) }} @else # @endcan">
                                                <img src="{{ !empty($member->user->avatar) ? uploadedAsset($member->user->avatar,'users'): asset('images/user.jpg') }}" alt="{{ $member->user->fullname }}">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endif
                
                    </div>
                </div>
            </div>
            @endforeach
           @endif
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
