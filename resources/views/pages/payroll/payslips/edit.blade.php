<div class="modal-body">
    <form action="{{ route('payslips.update', $payslip->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="row" x-data="{type: '{{ $payslip->type->value }}'}">
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
                        <x-form.input type="text" name="title" value="{{ $payslip->title }}" />
                    </x-form.input-block>
                </div>
                <div x-show="type === 'weekly'" class="col-md-12">
                    <x-form.input-block>
                        <x-form.label> {{ __('Weeks') }} <small class="text-info">{{ __('base salary multiply by weeks') }}</small></x-form.label>
                        <x-form.input type="number" name="weeks" value="{{ $payslip->weeks }}" />
                    </x-form.input-block>
                </div>
                <div class="row" x-show="type === 'hourly'">
                    <small class="text-info">{{ __('Attendance Date Range to use for hours calculation') }}</small>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('From Date') }}</x-form.label>
                            <div class="cal-icon">
                                <x-form.input type="text" class="datepicker" name="from_date" value="{{ $payslip->startDate }}" />
                            </div>
                        </x-form.input-block>
                    </div>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('To Date') }}</x-form.label>
                            <div class="cal-icon">
                                <x-form.input type="text" class="datepicker" name="to_date" value="{{ $payslip->endDate }}" />
                            </div>
                        </x-form.input-block>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label> {{ __('Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="payslip_date" value="{{ $payslip->payslip_date }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label> {{ __('Employee') }}</x-form.label>
                    <select name="employee" class="form-control">
                        <option value="">{{ __('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option {{ $payslip->employee_detail_id == $employee->employeeDetail->id ? 'selected': '' }} value="{{ $employee->employeeDetail->id }}">{{ $employee->fullname }}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
            <div class="col">
                <div class="status-toggle">
                    <x-form.label for="use_allowance">{{ __('Use Allowance ?') }}</x-form.label>
                    <input type="text" class="form-control check" type="checkbox" id="use_allowance" name="use_allowance" checked="{{ !empty($payslip->use_allowance) ? 'checked':'' }}">
                    <label for="use_allowance" class="checktoggle">checkbox</label>
                </div>
            </div>
            
            <div class="col">
                <div class="status-toggle">
                    <x-form.label for="use_deductions">{{ __('Use Deductions ?') }}</x-form.label>
                    <input class="form-control check" type="checkbox" id="use_deductions" name="use_deductions" checked="{{ !empty($payslip->use_deduction) ? 'checked':'' }}">
                    <label for="use_deductions" class="checktoggle">checkbox</label>
                </div>
            </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
