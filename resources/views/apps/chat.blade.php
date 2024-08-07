@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
    <!-- /Page Css -->
@endpush

@section('sidebar')
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <nav class="greedy">
                    <ul class="link-item">
                        <li>
                            <a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span>{{ __('Back To Dashboard') }}</span></a>
                        </li>
                        @livewire('apps.chat.sidebar')
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
@endsection

@section('page-content')
    <!-- Chat Main Row -->
    <div class="chat-main-row">

        <!-- Chat Main Wrapper -->
        @livewire('apps.chat.box',['userId' => request()->get('contact')])            
        <!-- /Chat Main Wrapper -->

    </div>
    <!-- /Chat Main Row -->
@endsection

@section('vendor-scripts')
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
@vite([
    'resources/js/app/chat/chat-app.js'
])
@endsection