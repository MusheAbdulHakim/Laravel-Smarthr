@extends('layouts.app')

@push('page-styles')
    @vite('Modules/Whiteboard/resources/apps/ExcaliDraw/app.scss')
@endpush

@section('page-content')
    <div class="content container-fluid">        
        <div id="ExcalidrawApp"></div>
    </div>
@endsection


@push('page-scripts')
    @vite("Modules/Whiteboard/resources/apps/ExcaliDraw/main.jsx")
    <script type="module">
        $(document).ready(function(){
            $('html').attr('data-sidebar-size','sm-hover')
        })
    </script>
    <!-- /Page Js -->
@endpush
