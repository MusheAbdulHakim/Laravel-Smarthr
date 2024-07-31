
@extends('layouts.app')

@section('page-content')
<div class="chat-main-row">
    <div class="chat-main-wrapper">
        <div class="col-lg-8 message-view task-view">
            <div class="chat-window">
                <div class="fixed-header">
                    <div class="navbar">
                        <div class="float-start ticket-view-details">
                            <div class="ticket-header">
                                <span>{{ __('Status') }}: </span> <span class="badge badge-warning">{{ $ticket->status->name ?? '' }}</span> 
                                <span class="m-l-15 text-muted">{{ __('Created By') }}: </span>
                                <a href="#">{{ $ticket->createdBy->fullname ?? '' }}</a>    
                                <span class="m-l-15 text-muted">Created: </span>
                                <span>{{ $ticket->created_at->format('Y-m-d H:i:s A') }} </span> 
                                @if (!empty($ticket->user_id))
                                <span class="m-l-15 text-muted">{{ __('Support') }}:</span>
                                <span><a href="#">{{ $ticket->user->fullname }}</a></span>
                                @endif
                            </div>
                        </div>
                        <a class="task-chat profile-rightbar float-end" id="task_chat" href="#task_window"><i class="fa fa fa-comment"></i></a>
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
                                                    <span class="h5 card-title ">{{ $ticket->subject }}</span>
                                                    @if (!empty($ticket->priority))
                                                    <div class="float-end ticket-priority"><span>{{ __('Priority') }}:</span>
                                                        <div class="btn-group">
                                                            <a href="#" class="badge badge-danger"> <i class="fa-regular fa-circle-dot text-primary"></i>{{ $ticket->priority->name }} </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                {!! $ticket->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if (!empty($ticketFiles) && $ticketFiles->count() > 0)
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h5 class="card-title m-b-20">{{ __('Uploaded files') }}</h5>
                                            <ul class="files-list">
                                                @foreach ($ticketFiles as $file) 
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
                                <div class="notification-popup hide">
                                    <p>
                                        <span class="task"></span>
                                        <span class="notification-text"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 message-view task-chat-view ticket-chat-view" id="task_window">
            <livewire:ticket-chat :ticket="$ticket" />
        </div>
    </div>
</div>

<!-- Assignee Modal -->
<div id="assignee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Assign User To Ticket') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ticket.assign-user') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket" value="{{ $ticket->id }}">
                    <div class="input-block mb-3">
                        <x-form.label>{{ __('User') }}</x-form.label>
                        <select name="user" class="form-control">
                            <option value=""> {{ __('Select User') }} </option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">{{ __('Assign') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Assignee Modal -->

@endsection



@push('page-scripts')
@vite([
    "resources/assets/css/ckeditor.css",
    "resources/js/ckeditor.js"
])
@endpush