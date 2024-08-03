<div class="modal-body">
    <form action="{{ route('allowances.update', $allowance->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <select name="employee" class="form-control">
                <option value="">{{ __('Select Employee') }}</option>
                @foreach ($employees as $employee)
                    <option {{ $allowance->employee_detail_id == $employee->employeeDetail->id ? 'selected': '' }} value="{{ $employee->employeeDetail->id }}">{{ $employee->fullname }}</option>
                @endforeach
            </select>
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Allowance Name" value="{{ $allowance->name }}" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Amount') }}</x-form.label>
            <x-form.input type="text" name="amount" placeholder="Arrears of salary" value="{{ $allowance->amount }}" />
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
