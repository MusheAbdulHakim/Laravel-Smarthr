@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

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
                {{ __('Task Board') }}
            </li>
        </ul>
    </x-breadcrumb>
    <!-- /Page Header -->

    <div class="row board-view-header">
        <div class="col-4">
            <div class="pro-teams">
                <div class="pro-team-lead">
                    <h4>{{ __('Lead') }}</h4>
                    <div class="avatar-group">
                        <div class="avatar">
                            <img class="avatar-img rounded-circle border border-white" src="{{ !empty($project->leader->avatar) ? uploadedAsset($project->leader->avatar,'users'): asset('images/user.jpg') }}" alt="{{ __('avatar') }}">
                        </div>
                    </div>
                </div>
                @php
                    $projectTeam = $project->team;
                @endphp
                @if (!empty($projectTeam) && $projectTeam->count())  
                <div class="pro-team-members">
                    <h4>{{ __('Team') }}</h4>
                    <div class="avatar-group">
                        @foreach ($projectTeam as $member)
                        <div class="avatar">
                            <img class="avatar-img rounded-circle border border-white" src="{{ !empty($member->user->avatar) ? uploadedAsset($member->user->avatar,'users'): asset('images/user.jpg') }}" alt="{{ $member->user->fullname.' avatar' }}">
                        </div>
                        @endforeach
                      
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-8 text-end">
            <a href="javascript:void(0)" class="btn btn-white float-end ms-2"
                data-url="{{ route('task-boards.create',['project_id' => $project->id]) }}" data-ajax-modal="true"
                data-size="md" data-title="Add Task Board">
                <i class="fa-solid fa-plus"></i> {{ __('Create List') }}
            </a>
            <a href="{{ route('projects.show', ['project' => \Crypt::encrypt($project->id)]) }}" class="btn btn-white float-end" data-bs-toggle="tooltip" title="View Project"><i class="fa fa-link"></i></a>
        </div>
    </div>    
    <div class="kanban-board card mb-0">
        <div class="card-body">
            <div class="kanban-cont">
                @foreach ($taskBoards as $board)
                <div class="kanban-list">
                    <div class="kanban-header" style="background: {{ $board->color ?? '#42a5f5' }};">
                        <span class="status-title">{{ $board->name }}</span>
                        <div class="dropdown kanban-action">
                            <a href="#" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item" data-url="{{ route('task-boards.edit', ['task_board' => $board->id, 'project_id' => $project->id]) }}" data-ajax-modal="true"
                                    data-title="{{ __('Edit Task Board') }}" data-size="md">{{ __('Edit') }}</a>
                                <a class="dropdown-item deleteBtn" data-route="{{ route('task-boards.destroy', ['task_board' => $board->id, 'project_id' => $project->id]) }}" data-title="{{ __('Delete Task Board') }}"
                                    data-question="{{ __('Are you sure you want to delete taskboard?') }}" href="javascript:void(0)"> 
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @php
                        $tasks = $board->tasks()->orderBy('priority')->get()
                    @endphp
                    <div class="kanban-wrap" data-board="{{ $board->id }}">
                        @foreach ($tasks as $task)
                        <div class="card panel" style="color: {{ $board->color ?? '#42a5f5' }} !important;" data-id="{{ $task->priority }}" data-task="{{ $task->id }}" data-board="{{ $board->id }}">
                            <div class="kanban-box">
                                <div class="task-board-header">
                                    <span class="status-title"><a href="javascript:void(0);">{{ $task->name }}</a></span>
                                    <div class="dropdown kanban-task-action">
                                        <a href="#" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)" data-ajax-modal="true" data-title="{{ __('Edit Task') }}" data-url="{{ route('project-tasks.edit',$task->id) }}" data-size="md">
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item deleteBtn" data-route="{{ route('project-tasks.destroy', $task->id) }}" data-title="{{ __('Delete Task') }}"
                                                data-question="{{ __('Are you sure you want to delete Task?') }}" href="javascript:void(0)">
                                                {{ __('Delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="task-board-body">
                                    <div class="kanban-info">
                                        <p>{{ $task->description }}</p>
                                    </div>
                                    <div class="kanban-footer">
                                        <span class="task-info-cont">
                                            <span class="task-date"><i class="fa-regular fa-clock"></i> {{ format_date($task->startDate) }} - {{ format_date($task->endDate) }}</span>
                                        </span>
                                        <span class="task-users">
                                            @if (!empty($task->followers) && $task->followers->count() > 0)
                                            <img src="{{ !empty($task->followers->first()->user->avatar) ? uploadedAsset($task->followers->first()->user->avatar,'users'): asset('images/user.jpg') }}" class="task-avatar" width="24" height="24" alt="avatar">
                                            <span class="task-user-count">{{ $task->followers->count() ?? 0 }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="add-new-task">
                        <a href="javascript:void(0);" data-ajax-modal="true" data-url="{{ route('project-tasks.create',['project' => $project->id,'board' => $board->id]) }}" data-size="md" data-title="{{ __('Add Task') }}">{{ __('Add New Task') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>  

</div>

@endsection


@push('page-scripts')
    <!-- Page Js -->
    <script type="module">
        var taskBoxWrapper = [].slice.call(document.querySelectorAll('.kanban-wrap'));
        for (var i = 0; i < taskBoxWrapper.length; i++) {
            new Sortable(taskBoxWrapper[i], {
                group: 'taskboard',
                handle: ".kanban-box",
                draggable: ".panel",
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                dataIdAttr: 'data-id', 
                onEnd: function (event) {
                    var element = $(event.item)
                    var priority = event.newIndex
                    var taskId = element.data('task')
                    let taskBoard = $(event.to).data('board')
                    $.ajax({
                        url: "{{ route('project-task.update-dragged') }}",
                        type: "POST",
                        data: {
                            task: taskId,
                            priority: priority,
                            board: taskBoard,
                        },  
                        success: function(e)
                        {
                            if(e.success){
                                Toastify({
                                    text: "{{ __('Task updated successfully') }}",
                                    className: "success",
                                }).showToast();
                            }else{
                                alert('something went wrong')
                            }
                        }
                    })                   
                },
            });
        }
    </script>
    <!-- /Page Js -->
@endpush
