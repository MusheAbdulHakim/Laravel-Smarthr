@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">
        <div id="ExcalidrawApp"></div>
    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    @vite([
        'Modules/Whiteboard/resources/apps/Excalidraw/css/index.scss',
        'Modules/Whiteboard/resources/apps/Excalidraw/main.jsx',
    ])
    <script type="module">
        $(document).ready(function(){
            $('html').attr('data-sidebar-size','sm-hover')
        })
    </script>
    <!-- /Page Js -->
@endpush