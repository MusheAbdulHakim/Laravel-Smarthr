@extends('layouts.app')



@section('page-content')
    <div class="content container-fluid mb-5">
        <div id="TldrawAppElement"></div>
    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    @vite([
        'Modules/Whiteboard/resources/apps/TlDraw/css/index.css',
        'Modules/Whiteboard/resources/apps/TlDraw/main.jsx',
    ])
    <script type="module">
        $(document).ready(function(){
            $('html').attr('data-sidebar-size','sm-hover')
        })
    </script>
    <!-- /Page Js -->
@endpush
