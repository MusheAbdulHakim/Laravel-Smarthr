@extends('layouts.frontend')

@section('content')

<div class="col-md-8">
    <div class="job-info job-widget">
        <h3 class="job-title">{{$job->title}}</h3>
        <span class="job-dept">{{$job->department->name}}</span>
        <ul class="job-post-det">
            <li><i class="fa fa-calendar"></i> Post Date: <span class="text-blue">{{\Carbon\Carbon::parse($job->start_date)->diffForHumans()}}</span></li>
            <li><i class="fa fa-calendar"></i> Last Date: <span class="text-blue">{{\Carbon\Carbon::parse($job->expire_date)->diffForHumans()}}</span></li>
            <li><i class="fa fa-user-o"></i> Applications: <span class="text-blue">{{$job->JobApplicants->count()}}</span></li>
        </ul>
    </div>
    <div class="job-content job-widget">
        {!! $job->description !!}
    </div>
</div>
<div class="col-md-4">
    <div class="job-det-info job-widget">
        <a class="btn job-btn" href="#" data-toggle="modal" data-target="#apply_job">Apply For This Job</a>
        <div class="info-list">
            <span><i class="fa fa-bar-chart"></i></span>
            <h5>Job Type</h5>
            <p> {{$job->type}}</p>
        </div>
        <div class="info-list">
            <span><i class="fa fa-money"></i></span>
            <h5>Salary</h5>
            <p>${{$job->salary_from}} - ${{$job->salary_to}}</p>
        </div>
        <div class="info-list">
            <span><i class="fa fa-suitcase"></i></span>
            <h5>Experience</h5>
            <p>{{$job->experience}} Years</p>
        </div>
        <div class="info-list">
            <span><i class="fa fa-ticket"></i></span>
            <h5>Vacancy</h5>
            <p>{{$job->vacancy}}</p>
        </div>
        <div class="info-list">
            <span><i class="fa fa-map-signs"></i></span>
            <h5>Location</h5>
            <p> {{$job->location}}</p>
        </div>
        
        <div class="info-list text-center">
            <a class="app-ends" href="#">Application ends in {{\Carbon\Carbon::parse($job->expire_date)->diffForHumans()}}</a>
        </div>
    </div>
</div>

<!-- Apply Job Modal -->
<div class="modal custom-modal fade" id="apply_job" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Your Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('apply-job')}}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control" name="email" type="text">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload your CV</label>
                        <div class="custom-file">
                            <input type="file" name="cv" class="custom-file-input" id="cv_upload">
                            <label class="custom-file-label" for="cv_upload">Choose file</label>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Apply Job Modal -->
@endsection