@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    @vite([
        'Modules/Whiteboard/resources/apps/TlDraw/css/index.css',
        'Modules/Whiteboard/resources/apps/TlDraw/main.jsx',
    ])
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">
        <div id="TldrawAppElement"></div>
    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <script>
        $(document).ready(function(){
            $('html').attr('data-sidebar-size','sm-hover')
        })
    </script>
    <!-- /Page Js -->
@endpush
