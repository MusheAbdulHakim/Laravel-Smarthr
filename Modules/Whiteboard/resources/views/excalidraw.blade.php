@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    @vite([
        'Modules/Whiteboard/resources/apps/Excalidraw/css/index.scss',
        'Modules/Whiteboard/resources/apps/Excalidraw/main.jsx',
    ])
    <!-- /Page Css -->
@endpush


@section('page-content')
    <div class="content container-fluid">
        <div id="ExcalidrawApp"></div>
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