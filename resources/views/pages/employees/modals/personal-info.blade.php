<div class="modal-body">
    <form action="{{ route('employee.personal-info', $employeeDetail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="row">
        <div class="col-md-6">
          <x-form.input-block>
                <x-form.label> {{ __('Passport No.') }}</x-form.label>
                <x-form.input type="text" name="passport" value="{{ $employeeDetail->passport_no }}" />
            </x-form.input-block>
        </div>
        <div class="col-md-6">
          <x-form.input-block>
                <x-form.label> {{ __('Passport Expiry Date') }}</x-form.label>
                <div class="cal-icon">
                <x-form.input type="text" class="datepicker" name="expiry_date" value="{{ $employeeDetail->passport_expiry_date }}" />
                </div>
            </x-form.input-block>
        </div>
        <div class="col-md-6">
          <x-form.input-block>
                <x-form.label> {{ __('Date Of Birth') }}</x-form.label>
                <div class="cal-icon">
                <x-form.input type="text" class="datepicker" name="dob" value="{{ $employeeDetail->dob }}" />
                </div>
            </x-form.input-block>
        </div>
        <div class="col-md-6">
          <x-form.input-block>
                <x-form.label> {{ __('Date Joined') }}</x-form.label>
                <div class="cal-icon">
                <x-form.input type="text" class="datepicker" name="date_joined" value="{{ $employeeDetail->date_joined }}" />
                </div>
            </x-form.input-block>
        </div>
        <div class="col-md-6">
          <x-form.input-block>
            <x-form.label> {{ __('Tel') }}</x-form.label>
            <x-form.input type="tel" name="tel" value="{{ $employeeDetail->passport_tel }}" />
            </x-form.input-block>
        </div>
        <div class="col-md-6">
            <x-form.input-block>
                <x-form.label> {{ __('Nationality') }}</x-form.label>
                <x-form.input type="text" name="nationality" value="{{ $employeeDetail->nationality }}" />
            </x-form.input-block>
        </div>
        <div class="col-md-6">
            <x-form.input-block>
                <x-form.label> {{ __('Religion') }}</x-form.label>
                <x-form.input type="text" name="religion" value="{{ $employeeDetail->religion }}" />
            </x-form.input-block>
        </div>
        <div class="col-md-6">
          <x-form.input-block>
                <x-form.label> {{ __('Marital status') }}</x-form.label>
                <select class="select form-control" name="marital_status">
                    <option>-</option>
                    @foreach (\App\Enums\MaritalStatus::cases() as $item)
                        <option value="{{ $item->value }}" {{ (!empty($employeeDetail->marital_status) && ($employeeDetail->marital_status->value == $item->value)) ? 'selected': ''}}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </x-form.input-block>
        </div>
        <div class="col-md-6">
            <x-form.input-block>
                <x-form.label> {{ __('Employement of spouse') }}</x-form.label>
                <x-form.input type="text" name="spouse_occupation" value="{{ $employeeDetail->spouse_occupation }}" />
            </x-form.input-block>
        </div>
        <div class="col-md-6">
            <x-form.input-block>
                <x-form.label> {{ __('No. of children') }}</x-form.label>
                <x-form.input type="text" name="children" value="{{ $employeeDetail->no_of_children }}"/>
            </x-form.input-block>
        </div>
      </div>
      <div class="submit-section my-3">
        <button type="submit" class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
      </div>
    </form>
</div>

