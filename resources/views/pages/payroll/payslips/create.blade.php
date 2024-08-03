<div class="modal-body">
    <form action="{{ route('payslips.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="row" x-data="{type}">
                <div class="col-md-12">
                    <x-form.input-block>
                        <x-form.label> {{ __('Type') }}</x-form.label>
                        <select x-model="type" name="type" id="type" class="form-control">
                            <option value="">{{ __('Select Payslip type') }}</option>
                            @foreach (\App\Enums\Payroll\SalaryType::cases() as $item)
                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </x-form.input-block>
                </div>
                <div x-show="type === 'contract'" class="col-md-12">
                    <x-form.input-block>
                        <x-form.label> {{ __('Payslip Title') }}</x-form.label>
                        <x-form.input type="text" name="title" />
                    </x-form.input-block>
                </div>
                <div x-show="type === 'weekly'" class="col-md-12">
                    <x-form.input-block>
                        <x-form.label> {{ __('Weeks') }} <small class="text-info">{{ __('base salary multiply by weeks') }}</small></x-form.label>
                        <x-form.input type="number" name="weeks" />
                    </x-form.input-block>
                </div>
                <div class="row" x-show="type === 'hourly'">
                    <small class="text-info">{{ __('Attendance Date Range to use for hours calculation') }}</small>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('From Date') }}</x-form.label>
                            <div class="cal-icon">
                                <x-form.input type="text" class="datepicker" name="from_date" />
                            </div>
                        </x-form.input-block>
                    </div>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('To Date') }}</x-form.label>
                            <div class="cal-icon">
                                <x-form.input type="text" class="datepicker" name="to_date" />
                            </div>
                        </x-form.input-block>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label> {{ __('Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="payslip_date" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label> {{ __('Employee') }}</x-form.label>
                    <select name="employee" class="form-control">
                        <option value="">{{ __('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->employeeDetail->id }}">{{ $employee->fullname }}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
            <div class="col">
                <div class="status-toggle">
                    <x-form.label>{{ __('Use Allowance ?') }}</x-form.label>
                    <x-form.input type="checkbox" id="use_allowance" class="check" name="use_allowance" />
                    <label for="use_allowance" class="checktoggle">checkbox</label>
                </div>
            </div>
            
            <div class="col">
                <div class="status-toggle">
                    <x-form.label>{{ __('Use Deductions ?') }}</x-form.label>
                    <x-form.input type="checkbox" id="use_deductions" class="check" name="use_deductions" />
                    <label for="use_deductions" class="checktoggle">checkbox</label>
                </div>
            </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
