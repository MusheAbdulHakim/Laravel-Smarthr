@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Attendances') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Attendance List') }}
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form action="" method="get">
            <div x-data="{employee: '{{ request()->employee }}', month: '{{ request()->month }}',year: '{{ request()->year }}'}" class="row filter-row">
                <div class="col-sm-6 col-md-3">  
                    <div class="input-block mb-3 form-focus">
                        <input type="text" name="employee" x-model="employee" class="form-control floating">
                        <label class="focus-label">{{ __('Employee Name') }}</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3"> 
                    <div class="input-block mb-3 form-focus select-focus">
                        <select name="month" x-model="month" class="select floating"> 
                            <option value=""> - </option>
                            <option value="01">{{ __('Jan') }}</option>
                            <option value="02">{{ __('Feb') }}</option>
                            <option value="03">{{ __('Mar') }}</option>
                            <option value="04">{{ __('Apr') }}</option>
                            <option value="05">{{ __('May') }}</option>
                            <option value="06">{{ __('Jun') }}</option>
                            <option value="07">{{ __('Jul') }}</option>
                            <option value="08">{{ __('Aug') }}</option>
                            <option value="09">{{ __('Sep') }}</option>
                            <option value="10">{{ __('Oct') }}</option>
                            <option value="11">{{ __('Nov') }}</option>
                            <option value="12">{{ __('Dec') }}</option>
                        </select>
                        <label class="focus-label">{{ __('Select Month') }}</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3"> 
                    <div class="input-block mb-3 form-focus select-focus">
                        <select name="year" x-model="year" class="select floating"> 
                            <option value=""> - </option>
                            @foreach ($years_range as $year)
                            <option>{{$year->year}}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">{{ __('Select Year') }}</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">  
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
                    </div>
                </div>       
            </div>
        </form> 
        <!-- /Search Filter -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Employee') }}</th>
                                @for ($day = 1; $day <= $days_in_month; $day++)
                                <th>{{$day}}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($employees))
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>    
                                    @php
                                        $img = !empty($employee->avatar) ? asset('storage/users/'.$employee->avatar): asset('images/user.jpg');
                                        $link = route('employees.show', ['employee' => Crypt::encrypt($employee->id)]);
                                    @endphp 
                                    {!! \Spatie\Menu\Laravel\Html::userAvatar($employee->fullname, $img, $link) !!}
                                    </td>
                                    @for ($day = 1; $day <= $days_in_month; $day++)
                                        @php
                                            $currentMonth = request()->month ?? now()->month;
                                            $year = request()->year ?? now()->year;
                                            $attendance = $employee->attendances()
                                                    ->whereDay('created_at', $day)
                                                    ->whereMonth('created_at', $currentMonth)
                                                    ->whereYear('created_at', $year)
                                                    ->first();
                                        @endphp
                                        @if (!empty($attendance->startDate) && !empty($attendance->endDate))
                                        <td><a href="javascript:void(0);" data-ajax-modal="true" data-title="{{ __('Attendance Details') }}" data-size="lg" data-url="{{ route('attendance.details', $attendance->id) }}"><i class="fa-solid fa-check text-success"></i></a></td>
                                        @else
                                        <td><a href="javascript:void(0);"><i class="fa-solid fa-close text-danger"></i></a></td>
                                        @endif
                                    @endfor
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <!-- /Page Js -->
@endpush
