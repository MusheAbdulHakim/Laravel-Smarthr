@extends('layouts.frontend')

@section('content')

@foreach ($jobs as $job)
    @if (!empty($job->department))
    <div class="col-md-6">
        <a class="job-list" href="{{route('job-view',$job)}}">
            <div class="job-list-det">
                <div class="job-list-desc">
                    <h3 class="job-list-title">{{$job->title}}</h3>
                    <h4 class="job-department">{{$job->department->name}}</h4>
                </div>
                <div class="job-type-info">
                    <span class="job-types">{{$job->type}}</span>
                </div>
            </div>
            <div class="job-list-footer">
                <ul>
                    <li><i class="fa fa-map-signs"></i> California</li>
                    <li><i class="fa fa-money"></i> ${{$job->salary_from}}-${{$job->salary_to}}</li>
                    <li><i class="fa fa-clock-o"></i> {{$job->created_at->diffForHumans()}}</li>
                </ul>
            </div>
        </a>
    </div>
    @endif
@endforeach

@endsection