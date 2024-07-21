<div class="modal-body">
    <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name" />
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
                                <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label calss="focus-label"> {{ __('Start Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="startDate" value="{{ old('startDate') }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label calss="focus-label"> {{ __('End Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" value="{{ old('endDate') }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Rate') }}</x-form.label>
                            <x-form.input type="text" name="rate" placeholder="10" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <x-form.input-block>
                            <x-form.label>&nbsp;</x-form.label>
                            <select class="form-control" name="rateType">
                                <option>{{ __('Hourly') }}</option>
                                <option>{{ __('Fixed') }}</option>
                            </select>
                        </x-form.input-block>
                    </div>
                    <div class="col-sm-6">
                        <x-form.input-block>
                            <x-form.label>{{ __('Priority') }}</x-form.label>
                            <select name="priority" class="form-control">
                                <option>{{ __('High') }}</option>
                                <option>{{ __('Medium') }}</option>
                                <option>{{ __('Normal') }}</option>
                                <option>{{ __('Low') }}</option>
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
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
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
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Brief Description') }}</label>
                    <x-form.textarea name="short_desc">{{ old('short_desc') }}</x-form.textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <x-form.ckeditor name="description" id="editor"></x-form.ckeditor>
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
