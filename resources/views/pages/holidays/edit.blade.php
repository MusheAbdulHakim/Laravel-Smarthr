<div class="modal-body">
    <form action="{{ route('holidays.update', $holiday->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">            
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name" placeholder="Christmas" value="{{ $holiday->name ?? old('name') }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Start Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="startDate" value="{{ $holiday->startDate ?? old('startDate') }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('End Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" value="{{ $holiday->endDate ?? old('endDate') }}" />
                    </div>
                </x-form.input-block>
            </div>
            
            <div class="col-md-6">
                <x-form.input-block>
                <x-form.label> {{ __('Color') }}</x-form.label>
                <select class="select form-control" name="color">
                    <option> - </option>
                    @foreach (\App\Enums\CalendarColors::cases() as $item)
                        <option value="{{ $item->value }}" {{ (!empty($holiday->color) && ($holiday->color->value == $item->value))  ? 'selected': ''}}>{{ $item->name }}</option>
                    @endforeach
                </select>
                </x-form.input-block>
            </div>
            <div class="col">
                <x-form.input-block>
                    <x-form.label>{{ __('Description') }}</x-form.label>
                    <x-form.textarea name="description">{{ $holiday->description }}</x-form.textarea>
                </x-form.input-block>
            </div>
        </div>
        <div class="col">
            <div class="status-toggle">
                <x-form.label>{{ __('Repeat Annually?') }}</x-form.label>
                <input type="checkbox" class="form-control check" id="is_annual" class="check" name="is_annual" {{ (!empty($holiday->is_annual)) ? 'checked': '' }}>
                <label for="is_annual" class="checktoggle">checkbox</label>
            </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
