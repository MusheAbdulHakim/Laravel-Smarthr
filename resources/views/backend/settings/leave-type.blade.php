@extends('layouts.backend-settings')

@section('styles')
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}"> 
@endsection

@section('content')

    @component('components.breadcrumb')                
        @slot('title') Leave Type @endslot
        @slot('li_1') Dashboard @endslot
        @slot('li_2') Leave Type @endslot
    @endcomponent        
                    
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Leave Type</th>
                            <th>Leave Days</th>
                            <th>Created At</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($leave_types as $leave_type)
                        <tr>
                            <td>
                                {{$count}}
                            </td>
                            <td>{{$leave_type->name}}</td>
                            <td>{{$leave_type->days.' '. Str::plural('Day',$leave_type->days)}}</td>
                            <td>
                                {{date_format(date_create($leave_type->created_at),'D M Y')}}
                            </td>
                            <td class="text-end">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$leave_type->id}}" data-name="{{$leave_type->name}}" data-days="{{$leave_type->days}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$leave_type->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
    
<x-modals.model-popup /> 
<x-modals.delete :route="route('leave-types')" title="leave type" /> 
@endsection

@push('page-js')
<!-- Data Table JS -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/datatable.init.js')}}"></script>
@endpush

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.table').on('click','.editbtn',(function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                var days = $(this).data('days');
                $('#edit_leavetype').modal('show');
                $('#edit_id').val(id);
                $('#edit_name').val(name);
                $('#edit_days').val(days);
            }));
        });
    </script>
@endsection