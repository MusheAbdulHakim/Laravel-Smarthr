@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
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
                            <a href="{{ route('dashboard') }}"><i class="la la-home"></i> <span>Back to Home</span></a>
                        </li>
                        <livewire:apps.chat.chat-sidebar lazy />
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
        <div class="chat-main-wrapper">

            <!-- Chats View -->
            <div class="col-lg-12 message-view task-view">
                <div class="chat-window">
                    @livewire('apps.chatbox',['default' => $default])
                </div>
            </div>
            <!-- /Chats View -->


        </div>
        <!-- /Chat Main Wrapper -->

    </div>
    <!-- /Chat Main Row -->
    
@endsection

@section('vendor-scripts')

@endsection