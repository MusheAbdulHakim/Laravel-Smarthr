<div class="modal-body">
    <form action="{{ route('deductions.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <select name="employee" class="form-control">
                <option value="">{{ __('Select Employee') }}</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->employeeDetail->id }}">{{ $employee->fullname }}</option>
                @endforeach
            </select>
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Allowance Name" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Amount') }}</x-form.label>
            <x-form.input type="text" name="amount" placeholder="Arrears of salary" />
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
