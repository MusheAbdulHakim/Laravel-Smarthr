<div class="modal-body">
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('First Name') }}</x-form.label>
                            <x-form.input type="text" name="firstname" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Middle Name') }}</x-form.label>
                            <x-form.input type="text" name="middlename" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Last Name') }}</x-form.label>
                            <x-form.input type="text" name="lastname" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('UserName') }}</x-form.label>
                            <x-form.input type="text" name="username" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Email') }}</x-form.label>
                            <x-form.input type="email" name="email" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <label>{{ __('Phone Number') }}</label>
                            <x-form.phone type="text" name="phone" />
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
                    <div class="col-sm-6">
                        <x-form.input-block>
                            <x-form.label>{{ __('Role') }}</x-form.label>
                            <select name="role" id="role" class="form-control select">
                                @foreach ($roles as $role)
                                    <option>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </x-form.input-block>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-block mb-3">
                            <x-form.label>
                                {{ __('Avatar') }}
                            </x-form.label>
                            <x-form.input type="file" name="avatar" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="address" />
                </div>
            </div>
            <div class="col-md-12">
                <x-form.label>{{ __('Active') }}</x-form.label>
                <div class="input-block">
                    <div class="status-toggle">
                        <x-form.input type="checkbox" id="status" class="check" name="status" />
                        <label for="status" class="checktoggle">checkbox</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="submit-section mb-2">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
