@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
  
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">{{ucwords($title)}}</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">View Ticket</li>
		</ul>
	</div>
	{{-- <div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_modal"><i class="fa fa-plus"></i> Add Modal</a>
	</div> --}}
</div>
@endsection


@section('content')
<div class="chat-main-row">
    <div class="chat-main-wrapper mt-4">
        <div class="col-lg-8 message-view task-view">
            <div class="chat-window">
                <div class="fixed-header">
                    <div class="navbar">
                        <div class="float-left ticket-view-details">
                            <div class="ticket-header">
                                <span>Status: </span> <span class="badge badge-warning">{{$ticket->status}}</span>
                                <span class="m-l-15 text-muted">Client: </span>
                                {{$ticket->client->firstname.' '.$ticket->client->lastname}}    
                                <span class="m-l-15 text-muted">Created: </span>
                                <span>{{date_format(date_create($ticket->created_at),'d M, Y H:i')}} </span> 
                            </div>
                        </div>
                        <div class="task-assign">
                            <span class="assign-title">Assigned to </span> 
                            @if (!empty($ticket->employee))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="{{$ticket->employee->firstname.' '.$ticket->employee->lastname}}" class="avatar">
                                <img src="{{!empty($ticket->employee->avatar) ? asset('storage/employees/'.$ticket->employee->avatar): asset('assets/img/profiles/avatar-19.jpg')}}" alt="avatar">
                            </a>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="chat-contents">
                    <div class="chat-content-wrap">
                        <div class="chat-wrap-inner">
                            <div class="chat-box">
                                <div class="task-wrapper">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="project-title">
                                                <div class="m-b-20">
                                                    <span class="h5 card-title ">{{$ticket->subject}}</span>
                                                    <div class="float-right ticket-priority"><span>Priority:</span>
                                                        <div class="btn-group">
                                                            
                                                            @switch($ticket->priority)
                                                                @case('high')
                                                                     <a href="#" class="badge badge-danger dropdown-toggle" data-toggle="dropdown">Highest </a>
                                                                    @break
                                                                @case('medium')
                                                                    <a href="#"><i class="fa fa-dot-circle-o text-primary"></i> Medium priority</a>
                                                                    @break
                                                                @case('low')
                                                                    <a href="#"><i class="fa fa-dot-circle-o text-success"></i> Low priority</a>
                                                                    @break
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! $ticket->description !!}
                                        </div>
                                    </div>
                                   
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h5 class="card-title m-b-20">Uploaded files</h5>
                                            <ul class="files-list">
                                                @if (!empty($ticket->files)) 
                                                    @foreach ($ticket->files as $file) 
                                                        <li>
                                                            <div class="files-cont">
                                                                <div class="file-type">
                                                                    <span class="files-icon"><i class="fa fa-file-o"></i></span>
                                                                </div>
                                                                <div class="files-info">
                                                                    <span class="file-name text-ellipsis">
                                                                    <a href="#">{{$file}}</a></span>
                                                                    <div class="file-size">Size: {{is_file(asset('storage/tickets/'.$ticket->subject.'/'.$file)) ? \Storage::size(public_path('storage/tickets/'.$ticket->subject.'/'.$file)): ''}}</div>
                                                                </div>
                                                                <ul class="files-action">
                                                                    <li class="dropdown dropdown-action">
                                                                        <a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="{{!empty($file) ? asset('storage/tickets/'.$ticket->subject.'/'.$file): '#'}}">Download</a>
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
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>

@endsection


@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

@endsection