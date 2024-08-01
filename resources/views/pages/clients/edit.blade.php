<div class="modal-body">
    <form action="{{ route('clients.update', $client->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('First Name') }}</x-form.label>
                            <x-form.input type="text" name="firstname" value="{{ $client->firstname }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Middle Name') }}</x-form.label>
                            <x-form.input type="text" name="middlename" value="{{ $client->middlename }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Last Name') }}</x-form.label>
                            <x-form.input type="text" name="lastname" value="{{ $client->lastname }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('UserName') }}</x-form.label>
                            <x-form.input type="text" name="username" value="{{ $client->username }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Email') }}</x-form.label>
                            <x-form.input type="email" name="email" value="{{ $client->email }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <label>{{ __('Phone Number') }}</label>
                            <x-form.phone type="text" name="phone" value="{{ $client->phone }}" />
                        </div>
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="address" value="{{ $client->address }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="input-block mb-3">
                <label class="col-form-label">{{ __('Avatar') }}</label>
                <x-form.input type="file" name="avatar" />
            </div>
            <div class="status-toggle">
                <input type="checkbox" id="status" class="form-control check" name="status"
                    checked="{{ !empty($client->is_active) ? 'checked' : '' }}" />
                <label for="status" class="checktoggle">checkbox</label>
            </div>
        </div>
        <div class="submit-section">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
