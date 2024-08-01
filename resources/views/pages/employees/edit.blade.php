<div class="modal-body">
    <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('First Name') }}</x-form.label>
                    <x-form.input type="text" name="firstname" value="{{ $employee->firstname }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Middle Name') }}</x-form.label>
                    <x-form.input type="text" name="middlename" value="{{ $employee->middlename }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Last Name') }}</x-form.label>
                    <x-form.input type="text" name="lastname" value="{{ $employee->lastname }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('UserName') }}</x-form.label>
                    <x-form.input type="text" name="username" value="{{ $employee->username }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Email') }}</x-form.label>
                    <x-form.input type="email" name="email" value="{{ $employee->email }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <label>{{ __('Phone Number') }}</label>
                    <x-form.phone type="text" name="phone" value="{{ $employee->phone }}" />
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Password') }}
                    </x-form.label>
                    <x-form.input type="password" name="password" />
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Confirm Password') }}
                    </x-form.label>
                    <x-form.input type="password" name="password_confirmation" />
                </x-form.input-block>
            </div>

            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Department') }}
                    </x-form.label>
                    <select name="department" id="department" class="select">
                        @if (!empty($departments))
                            @foreach ($departments as $department)
                                <option {{ (!empty($employee->employeeDetail) && ($employee->employeeDetail->department_id == $department->id)) ? 'selected': '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>
                        {{ __('Designation') }}
                    </x-form.label>
                    <select name="designation" id="designation" class="select">
                        @if (!empty($designations))
                            @foreach ($designations as $designation)
                                <option {{ (!empty($employee->employeeDetail) && ($employee->employeeDetail->designation_id == $designation->id)) ? 'selected': '' }} value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label>{{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="address" value="{{ $employee->address }}" />
                </x-form.input-block>
            </div>
            <div class="col">
                <x-form.input-block>
                    <label class="col-form-label">{{ __('Avatar') }}</label>
                    <x-form.input type="file" name="avatar" />
                </x-form.input-block>
            </div>
            <div class="col">
                <div class="status-toggle">
                    <x-form.label>{{ __('Status') }}</x-form.label>
                    <input type="checkbox" id="status" class="form-control check" name="status"
                        checked="{{ !empty($employee->is_active) ? 'checked' : '' }}" />
                    <label for="status" class="checktoggle">checkbox</label>
                </div>
            </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
