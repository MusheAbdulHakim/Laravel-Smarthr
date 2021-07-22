@extends('layouts.backend')

@section('page-header')
<div class="row align-items-center">
    <div class="col">
        <h3 class="page-title">Holidays</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Holidays</li>
        </ul>
    </div>
    <div class="col-auto float-right ml-auto">
        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>Title </th>
                        <th>Holiday Date</th>
                        <th>Day</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($holidays->count()))
                        @foreach ($holidays as $holiday)
                            <tr class="@if($holiday->completed) holiday-completed @endif holiday-upcoming">
                                <td>{{$holiday->name}}</td>
                                <td>{{date_format(date_create($holiday->holiday_date),'d M Y')}}</td>
                                <td>{{ date_format(date_create($holiday->holiday_date),'D') }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if(!$holiday->completed)
                                                <form action="{{route('completed',$holiday)}}" method="post">
                                                    @csrf
                                                    <button data-id="{{$holiday->id}}" class="dropdown-item btn mark_as_complete" type="submit"><i class="fa fa-star m-r-5"></i>Completed</button>
                                                    <input type="hidden" id="complete_id" name="id">
                                                </form>
                                            @endif
                                            <a data-id="{{$holiday->id}}" data-name="{{$holiday->name}}" data-date="{{$holiday->holiday_date}}" class="dropdown-item editbtn" href="javascript:void(0);" data-toggle="modal" data-target="#edit_holiday"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-id="{{$holiday->id}}" class="dropdown-item deletebtn" href="javascript:void(0);" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <x-modals.delete :route="'holiday.destroy'" :title="'holiday'" />
                        <!-- Edit Holiday Modal -->
                        <div class="modal custom-modal fade" id="edit_holiday" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Holiday</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('holidays')}}" method="post">
                                            @method("PUT")
                                            @csrf
                                            <input type="hidden" id="edit_id" name="id">
                                            <div class="form-group">
                                                <label>Holiday Name <span class="text-danger">*</span></label>
                                                <input class="form-control" id="edit_name" name="name" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Holiday Date <span class="text-danger">*</span></label>
                                                <div class="cal-icon"><input id="edit_date" class="form-control datetimepicker" name="holiday_date" type="text"></div>
                                            </div>
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Holiday Modal -->
                    @endif                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Holiday Modal -->
<div class="modal custom-modal fade" id="add_holiday" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Holiday Name <span class="text-danger">*</span></label>
                        <input name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Holiday Date <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                        <input name="holiday_date" class="form-control datetimepicker" type="text"></div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Holiday Modal -->


@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        // mark as complete 
        $('.mark_as_complete').on('click',function (){
            var id = $(this).data('id');
            console.log(id);
            $('#.complete_id').val(id);
        })
        // edit holiday 
        $('.editbtn').on('click',function (){
            $('#edit_holiday').modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var date = $(this).data('date');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_date').val(date);
        });
    });
</script>
@endsection