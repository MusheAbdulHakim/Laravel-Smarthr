<div class="modal-body">
    <form action="{{ route('family-information.update', $member->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user" value="{{ $member->user_id }}">
        <div class="form-scroll">
            <div class="card">
                <div class="card-body">
                <h3 class="card-title">
                    {{ __('Family Member') }}
                </h3>
                <div class="row">
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Name') }}</x-form.label>
                            <x-form.input type="text" name="name" value="{{ old('name', $member->name) }}" />
                        </x-form.input-block>
                    </div>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Relationship') }}</x-form.label>
                            <x-form.input type="text" name="relationship" value="{{ old('relationship', $member->relationship) }}" />
                        </x-form.input-block>
                    </div>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Date Of Birth') }}</x-form.label>
                            <x-form.input type="text" class="datepicker" name="dob" value="{{ old('dob', $member->dob) }}" />
                        </x-form.input-block>
                    </div>

                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Phone') }}</x-form.label>
                            <x-form.phone type="text" name="phone" value="{{ old('phone', $member->phone) }}" />
                        </x-form.input-block>
                    </div>
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Image') }}</x-form.label>
                            <x-form.input type="file" name="image" />
                        </x-form.input-block>
                    </div>
                    <div class="col-6">
                        <x-form.input-block>
                            <x-form.label> {{ __('Address') }}</x-form.label>
                            <x-form.input type="text" name="address" value="{{ old('address', $member->address) }}" />
                        </x-form.input-block>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="submit-section my-3">
            <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
        </div>
    </form>
</div>
