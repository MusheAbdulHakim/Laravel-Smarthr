<div class="modal-body">
    <form action="{{ route('holidays.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name" placeholder="Christmas" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Start Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="startDate" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('End Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" />
                    </div>
                </x-form.input-block>
            </div>
            
            <div class="col-md-6">
                <x-form.input-block>
                <x-form.label> {{ __('Color') }}</x-form.label>
                <select class="select form-control" name="color">
                    <option> - </option>
                    @foreach (\App\Enums\CalendarColors::cases() as $item)
                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                </x-form.input-block>
            </div>
            <div class="col">
                <x-form.input-block>
                    <x-form.label>{{ __('Description') }}</x-form.label>
                    <x-form.textarea name="description"></x-form.textarea>
                </x-form.input-block>
            </div>
        </div>
        <div class="col">
            <div class="status-toggle">
                <x-form.label>{{ __('Repeat Annually?') }}</x-form.label>
                <x-form.input type="checkbox" id="is_annual" class="check" name="is_annual" />
                <label for="is_annual" class="checktoggle">checkbox</label>
            </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
