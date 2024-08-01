<div class="modal-body">
    <form action="{{ route('project-tasks.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project_id ?? '' }}">
        <input type="hidden" name="board" value="{{ $board ?? '' }}">
        <div class="row">
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Priority') }}</x-form.label>
                    <x-form.input type="number" name="priority" />
                </div>
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
                    <x-form.label calss="focus-label"> {{ __('Due Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" value="{{ old('endDate') }}" />
                    </div>
                </x-form.input-block>
            </div>    
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <x-form.textarea name="description"></x-form.textarea>
                </div>
            </div>   
            <div class="col-12">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Assign Team') }}
                    </x-form.label>
                    <select name="team[]" class="form-control select" data-placeholder="{{ __('Select Employee') }}" multiple>
                        @if (!empty($employees))
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>         
        </div>
        <div class="submit-section mb-3">
            <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
        </div>
    </form>
</div>
