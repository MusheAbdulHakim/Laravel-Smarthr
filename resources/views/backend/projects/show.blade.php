@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">{{$project->name}}</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">show project</li>
		</ul>
	</div>
	
</div>
@endsection


@section('content')
     <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="project-title">
                            <h5 class="card-title">{{$project->name}}</h5>
                            <small class="block text-ellipsis m-b-15"><span class="text-xs">2</span> <span class="text-muted">open tasks, </span><span class="text-xs">5</span> <span class="text-muted">tasks completed</span></small>
                        </div>
                        <p>
                            {!! $project->description !!} 
                        </p>
                    </div>
                </div>
               
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-20">Uploaded files</h5>
                        <ul class="files-list">
                            @if (!empty($project->files)) 
                                @foreach ($project->files as $file) 
                                    <li>
                                        <div class="files-cont">
                                            <div class="file-type">
                                                <span class="files-icon"><i class="fa fa-file-o"></i></span>
                                            </div>
                                            <div class="files-info">
                                                <span class="file-name text-ellipsis">
                                                <a href="#">{{$file}}</a></span>
                                                <div class="file-size">Size: {{is_file(asset('storage/projects/'.$project->name.'/'.$file)) ? \Storage::size(public_path('storage/projects/'.$project->name.'/'.$file)): ''}}</div>
                                            </div>
                                            <ul class="files-action">
                                                <li class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle btn btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{!empty($file) ? asset('storage/projects/'.$project->name.'/'.$file): '#'}}">Download</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-20">Uploaded image files</h5>
                        <div class="row">
                            @if (!empty($project->files))
                                
                            @foreach ($project->files as $file)
                            @php
                                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
                                $explodeImage = explode('.', asset('storage/projects/'.$project->name.'/'.$file));
                                $extension = end($explodeImage);
                            @endphp 
                                @if (in_array($extension, $imageExtensions))  
                                <div class="col-md-3 col-sm-4 col-lg-4 col-xl-3">
                                    <div class="uploaded-box">
                                        <div class="uploaded-img">
                                            <img src="{{ asset('storage/projects/'.$project->name.'/'.$file) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="uploaded-img-name">
                                            {{$file}}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            @endif                            
                            
                        </div>
                    </div>
                </div>
                <div class="project-task">
                    <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                        <li class="nav-item"><a class="nav-link active" href="#all_tasks" data-bs-toggle="tab" aria-expanded="true">All Tasks</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending_tasks" data-bs-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
                        <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-bs-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="all_tasks">
                            <div class="task-wrapper">
                                <div class="task-list-container">
                                    <div class="task-list-body">
                                        <ul id="task-list">
                                            <li class="task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="completed task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label">Doctor available module</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label" contenteditable="true">Private chat module</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container">
                                                    <span class="task-action-btn task-check">
                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                    </span>
                                                    <span class="task-label" contenteditable="true">Patient Profile add</span>
                                                    <span class="task-action-btn task-btn-right">
                                                        <span class="action-circle large" title="Assign">
                                                            <i class="material-icons">person_add</i>
                                                        </span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                            <i class="material-icons">delete</i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="task-list-footer">
                                        <div class="new-task-wrapper">
                                            <textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
                                            <span class="error-message hidden">You need to enter a task first</span>
                                            <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                            <span class="btn" id="close-task-panel">Close</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="pending_tasks"></div>
                        <div class="tab-pane" id="completed_tasks"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title m-b-15">Project details</h6>
                        <table class="table table-striped table-border">
                            <tbody>
                                <tr>
                                    <td>Cost:</td>
                                    <td class="text-end">${{$project->rate}}</td>
                                </tr>
                                
                                <tr>
                                    <td>Created:</td>
                                    <td class="text-end">{{date_format(date_create($project->created_at),"d M, Y")}}</td>
                                </tr>
                                <tr>
                                    <td>Deadline:</td>
                                    <td class="text-end">{{date_format(date_create($project->end_date),"d M, Y")}}</td>
                                </tr>
                                <tr>
                                    <td>Priority:</td>
                                    <td class="text-end">
                                        {{$project->priority}}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <p class="m-b-5">Progress <span class="text-success float-end">{{$project->progress}}%</span></p>
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-success" role="progressbar" data-bs-toggle="tooltip" title="{{$project->progress}}%" style="width: {{$project->progress}}%"></div>
                        </div>
                    </div>
                </div>
                <div class="card project-user">
                    <div class="card-body">
                        <h6 class="card-title m-b-20">Assigned Leader </h6>
                        <ul class="list-box">
                            @php
                                $leader = $project->employee($project->leader);
                            @endphp
                            <li>
                                <a href="#">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar"><img alt="avatar" src="{{ !empty($leader->avatar) ? asset('storage/employees/'.$leader->avatar): asset('assets/img/user.jpg')}}"></span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{$leader->firstname.' '.$leader->lastname}}</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Team Leader</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="card project-user">
                    <div class="card-body">
                        <h6 class="card-title m-b-20">
                            Assigned users 
                        </h6>
                        <ul class="list-box">
                            @foreach ($project->team as $team_member)
                                @php
                                    $member = $project->employee($team_member);
                                @endphp
                            <li>
                                <a href="#">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar"><img alt=""  src="{{ !empty($member->avatar) ? asset('storage/employees/'.$member->avatar): asset('assets/img/user.jpg')}}"></span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{$member->firstname.' '.$member->lastname}}</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">{{$member->designation->name}}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
@endsection