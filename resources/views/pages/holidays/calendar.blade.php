@extends('layouts.app')

@push('page-styles')
@vite([
    'resources/assets/css/fullcalendar.min.css',
])
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Holidays') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Holidays') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a data-url="{{ route('holidays.create') }}" href="javascript:void(0)" class="btn add-btn"
                        data-ajax-modal="true" data-size="lg" data-title="Add Holiday">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Holiday') }}
                    </a>
                    <div class="view-icons">
                        <a href="{{ route('holidays.index') }}" data-bs-toggle="tooltip" data-bs-title="{{ __("Holidays List") }}" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        <a href="{{ route('holidays.calendar') }}" data-bs-toggle="tooltip" data-bs-title="{{ __("Holidays Calendar") }}" class="grid-view btn btn-link active"><i class="fa fa-calendar"></i></a>
                    </div>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <!-- Calendar -->
                                <div id="calendar"></div>
                                <!-- /Calendar -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-scripts')
<script type="module">
    $(document).ready(function(){
        let calendarEl = document.getElementById('calendar');
        let calendar = new Calendar(calendarEl, {
            plugins: [
                dayGridPlugin,timeGridPlugin,listPlugin
            ],
            initialView: 'dayGridMonth',
            handleWindowResize: true,   
            height: $(window).height() - 200,   
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridDay'
            },    
            events: @json($events->all()),
            dateClick: function(info) {
                $('.add-btn').click();
            }
        });
        calendar.render();
    })
</script>
@endpush

