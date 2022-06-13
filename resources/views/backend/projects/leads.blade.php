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
		<h3 class="page-title">Project Leads</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">leads</li>
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
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lead Name</th>
                        <th>Email</th>
                        <th>Project</th>
                        <th>Assigned Staff</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{$count}}</td>
                        <td>
                            <h2 class="table-avatar">
                                @php
                                    $leader = $project->employee($project->leader);
                                @endphp
                                <a href="#" class="avatar" data-toggle="tooltip" title="{{$leader->firstname.' '.$leader->lastname}}">
                                    <img src="{{ !empty($leader->avatar) ? asset('storage/employees/'.$leader->avatar): asset('assets/img/user.jpg')}}">
                                </a>
                                <a href="#">{{$leader->firstname.' '.$leader->lastname}}</a>
                            </h2>
                        </td>
                        <td>{{$leader->email}}</td>
                        <td><a href="{{route('project.show',$project->name)}}">{{$project->name}}</a></td>
                        <td>
                            <ul class="team-members">
                                @foreach ($project->team as $team_member)
                                    @php
                                        $member = $project->employee($team_member);
                                    @endphp
                                    <li>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="{{$member->firstname.' '.$member->lastname}}"><img  src="{{ !empty($member->avatar) ? asset('storage/employees/'.$member->avatar): asset('assets/img/user.jpg')}}"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- /Page Content -->

<x-modals.popup />
<x-modals.delete route="projects" title="Project" />
@endsection


@section('scripts')
<!-- Summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.table').on('click','.editbtn',(function(){
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