<div class="modal-body">
    <form action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name"  value="{{ $project->name }}" />
                </div>
            </div>
            
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Client') }}
                    </x-form.label>
                    <select name="client" class="form-control">
                        @if (!empty($clients))
                            @foreach ($clients as $client)
                                <option {{ $project->client_id == $client->id ? 'selected': '' }} value="{{ $client->id }}">{{ $client->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label calss="focus-label"> {{ __('Start Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="startDate" value="{{ $project->startDate }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label calss="focus-label"> {{ __('End Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" value="{{ $project->endDate }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Rate') }}</x-form.label>
                            <x-form.input type="text" name="rate" placeholder="10" value="{{ $project->rate }}" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <x-form.input-block>
                            <x-form.label>&nbsp;</x-form.label>
                            <select class="form-control" name="rateType">
                                <option {{ $project->rateType == 'Hourly' ? 'selected': '' }}>{{ __('Hourly') }}</option>
                                <option {{ $project->rateType == 'Fixed' ? 'selected': '' }}>{{ __('Fixed') }}</option>
                            </select>
                        </x-form.input-block>
                    </div>
                    <div class="col-sm-6">
                        <x-form.input-block>
                            <x-form.label>{{ __('Priority') }}</x-form.label>
                            <select name="priority" class="form-control">
                                <option {{ $project->priority == 'High' ? 'selected': '' }}>{{ __('High') }}</option>
                                <option {{ $project->priority == 'Medium' ? 'selected': '' }}>{{ __('Medium') }}</option>
                                <option {{ $project->priority == 'Low' ? 'selected': '' }}>{{ __('Low') }}</option>
                            </select>
                        </x-form.input-block>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Add Project Leader') }}
                    </x-form.label>
                    <select name="leader" class="form-control">
                        <option value="">{{ __('Select Leader') }}</option>
                        @if (!empty($employees))
                            @foreach ($employees as $employee)
                                <option {{ $project->leader_id == $employee->id ? 'selected': '' }} value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Add Team') }}
                    </x-form.label>
                    <select name="team[]" class="form-control select" data-placeholder="{{ __('Select Team Member') }}" multiple>
                        @if (!empty($employees))
                            @foreach ($employees as $employee)
                                <option {{ in_array($employee->id, $project->team->pluck('user_id')->all()) ? 'selected': '' }} value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Brief Description') }}</label>
                    <x-form.textarea name="short_desc">{{ $project->short_desc }}</x-form.textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <x-form.ckeditor name="description" id="editor">{{ $project->description }} </x-form.ckeditor>
                </div>
            </div>
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Files') }}</label>
                    <x-form.input type="file" name="projectFiles[]" multiple />
                </div>
            </div>
            
        </div>
        <div class="submit-section mb-3">
            <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
        </div>
    </form>
</div>

