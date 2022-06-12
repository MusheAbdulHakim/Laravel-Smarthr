@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

<!-- Summernote CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Projects</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">projects</li>
		</ul>
	</div>
    <div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Add Modal</a>
		<div class="view-icons">
			<a href="{{route('projects')}}" class="grid-view btn btn-link {{route_is('projects') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('project-list')}}" class="list-view btn btn-link {{route_is('project-list') ? 'active' : '' }}" class=><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection


@section('content')
<div class="row">
    @foreach ($projects as $project)
    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="dropdown dropdown-action profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$project->id}}" data-name="{{$project->name}}" 
                            data-client="{{($project->client_id)}}" data-start="{{$project->start_date}}" data-end="{{$project->end_date}}"
                            data-rate="{{$project->rate}}" data-rtype="{{$project->rate_type}}" data-priority="{{$project->priority}}" 
                            data-leader="{{$project->leader}}" data-team="{{json_encode($project->team)}}" 
                            data-description="{{$project->description}}" data-progress="{{$project->progress}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$project->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div>
                <h4 class="project-title"><a href="{{route('project.show',$project->name)}}">{{$project->name}}</a></h4>
                <small class="block text-ellipsis m-b-15">
                    <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                    <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                </small>
                <p class="text-muted">
                    {!! substr($project->description,0,120)!!}
                </p>
                <div class="pro-deadline m-b-15">
                    <div class="sub-title">
                        Deadline:
                    </div>
                    <div class="text-muted">
                        {{date_format(date_create($project->end_date),"D M, Y")}}
                    </div>
                </div>
                <div class="project-members m-b-15">
                    <div>Project Leader :</div>
                    @php
                        $leader = $project->employee($project->leader);
                    @endphp
                    <ul class="team-members">
                        <li>
                            <a href="#" data-bs-toggle="tooltip" title="{{$leader->firstname.' '.$leader->lastname}}">
                                <img alt="avatar"  src="{{ !empty($leader->avatar) ? asset('storage/employees/'.$leader->avatar): asset('assets/img/user.jpg')}}">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="project-members m-b-15">
                    <div>Team :</div>
                   
                    <ul class="team-members">
                        @foreach ($project->team as $team_member)
                        @php
                            $member = $project->employee($team_member);
                        @endphp
                        <li>
                            <a href="#" data-bs-toggle="tooltip" title="{{$member->firstname.' '.$member->lastname}}"><img  src="{{ !empty($member->avatar) ? asset('storage/employees/'.$member->avatar): asset('assets/img/user.jpg')}}"></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <p class="m-b-5">Progress <span class="text-success float-end">{{$project->progress}}%</span></p>
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-success" role="progressbar" data-bs-toggle="tooltip" title="{{$project->progress}}%" style="width: {{$project->progress}}%"></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach            
</div>
</div>
<!-- /Page Content -->  

<x-modals.popup />
<x-modals.delete route="projects" title="Project" />
@endsection


@section('scripts')
<!-- summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.card').on('click','.editbtn',(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var client = $(this).data('client');
            var startdate = $(this).data('start');
            var enddate = $(this).data('end');
            var rate = $(this).data('rate');
            var rate_type = $(this).data('rtype');
            var priority = $(this).data('priority');
            var leader = $(this).data('leader');
            var team  = $(this).data('team');
            var description = $(this).data('description');
            var progress = $(this).data('progress');
            $('#edit_project').modal('show');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_client').val(client).trigger('change');
            $('#edit_startdate').val(startdate);
            $('#edit_enddate').val(enddate);
            $('#edit_rate').val(rate);
            $('#edit_priority').val(priority);
            $('#edit_leader').val(leader).trigger('change');
            $('#edit_team').val(team).trigger('change');
            $('#edit_description').summernote('code', description);
            $('#edit_progress').val(progress);
            $('#progress_result').html("Progress Value: " + progress);
            $('#edit_progress').change(function(){
                $('#progress_result').html("Progress Value: " + $(this).val());
            });
        }));
    });
</script>
@endsection