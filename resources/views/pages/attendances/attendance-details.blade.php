<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card punch-status">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Timesheet') }} <small class="text-muted">{{ $attendance->startDate }}</small></h5>
                    @if (!empty($attendance->created_at))
                    <div class="punch-det">
                        <h6>{{ __('First Punchedd In At') }}</h6>
                        <p>{{ $attendance->created_at->format('Y-m-d H:i:s A') }}</p>
                    </div>
                    @endif
                    <div class="punch-info">
                        <div class="punch-hours">
                            <span>{{ $totalHours }} {{ \Str::plural(__('Hour'), intval($totalHours)) }}</span>
                        </div>
                    </div>
                    @if (!empty($attendance->updated_at))
                    <div class="punch-det">
                        <h6>{{ __('Last Punch In At') }}</h6>
                        <p>{{ $attendance->updated_at->format('Y-m-d H:i:s A') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card recent-activity">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Activity') }}</h5>
                    <ul class="res-activity-list">
                        @if (!empty($attendanceActivity))
                            @foreach ($attendanceActivity as $item)
                            <li>
                                <p class="mb-0">{{ __('Punch In at') }}</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ !empty($item->startTime) ? $item->startTime->format('H:i A'): '' }}
                                </p>
                            </li>
                            @if (!empty($item->endTime))
                            <li>
                                <p class="mb-0">{{ __('Punch Out at') }}</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ !empty($item->endTime) ? $item->endTime->format('H:i A'): '' }}
                                </p>
                            </li>
                            <hr>
                            @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>