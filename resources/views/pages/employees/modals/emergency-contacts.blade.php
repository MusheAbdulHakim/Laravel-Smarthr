<div class="modal-body">
    <form action="{{ route('employee.emergency-contacts', $employeeDetail->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ __('Primary Contact') }}</h3>
          <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required> {{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="primary[name]" value="{{ $employeeDetail->emergency_contacts['primary']['name'] ?? '' }}" required />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required> {{ __('Relationship') }}</x-form.label>
                    <x-form.input type="text" name="primary[relationship]" value="{{ $employeeDetail->emergency_contacts['primary']['relationship'] ?? '' }}" required />
                </x-form.input-block>
            </div>

            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required> {{ __('Phone') }}</x-form.label>
                    <x-form.phone type="text" name="primary[phone]" value="{{ $employeeDetail->emergency_contacts['primary']['phone'] ?? '' }}" required />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required> {{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="primary[address]" value="{{ $employeeDetail->emergency_contacts['primary']['address'] ?? '' }}" required />
                </x-form.input-block>
            </div>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ __('Secondary Contact') }}</h3>
          <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="secondary[name]" value="{{ $employeeDetail->emergency_contacts['secondary']['name'] ?? '' }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Relationship') }}</x-form.label>
                    <x-form.input type="text" name="secondary[relationship]" value="{{ $employeeDetail->emergency_contacts['secondary']['relationship'] ?? '' }}" />
                </x-form.input-block>
            </div>

            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Phone') }}</x-form.label>
                    <x-form.phone type="text" name="secondary[phone]" value="{{ $employeeDetail->emergency_contacts['secondary']['phone'] ?? '' }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label> {{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="secondary[address]" value="{{ $employeeDetail->emergency_contacts['secondary']['address'] ?? '' }}" />
                </x-form.input-block>
            </div>

          </div>
        </div>
      </div>

      <div class="submit-section my-3">
        <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
      </div>
    </form>
  </div>
