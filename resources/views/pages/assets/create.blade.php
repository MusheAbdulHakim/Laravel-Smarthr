<div class="modal-body">
    <form action="{{ route('assets.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset Name') }}</x-form.label>
                    <x-form.input type="text" name="name" placeholder="{{ __('Enter Asset Name') }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset Id') }}</x-form.label>
                    <x-form.input type="text" name="ast_id" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Purchase Date') }}</x-form.label>
                    <x-form.input type="text" name="purchase_date" class="datepicker" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Purchase From') }}</x-form.label>
                    <x-form.input type="text" name="purchase_from" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Manufacturer') }}</x-form.label>
                    <x-form.input type="text" name="manufacturer" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Model') }}</x-form.label>
                    <x-form.input type="text" name="model" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Serial Number') }}</x-form.label>
                    <x-form.input type="text" name="serial_no" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Brand') }}</x-form.label>
                    <x-form.input type="text" name="brand" placeholder="Dell" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Supplier') }}</x-form.label>
                    <x-form.input type="text" name="supplier" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Condition') }}</x-form.label>
                    <x-form.input type="text" name="condition" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Warranty') }}</x-form.label>
                    <x-form.input type="integer" name="warranty" placeholder="{{ __('In months') }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Warranty End') }}</x-form.label>
                    <x-form.input type="text" name="warranty_end" class="datepicker" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Cost') }}</x-form.label>
                    <x-form.input type="text" name="cost" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset user') }}</x-form.label>
                    <select name="user" class="form-control select">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->firstname.' '.$user->lastname}}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Status') }}</x-form.label>
                    <select name="status" class="form-control">
                        <option value="approved">{{ __('Approved') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="returned">{{ __('Returned') }}</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Files') }}</x-form.label>
                    <x-form.input type="file" name="astFiles[]" multiple />
                </x-form.input-block>
            </div>
            <x-form.input-block>
                <x-form.label>{{ __('Description') }}</x-form.label>
                <x-form.textarea name="description"></x-form.textarea>
            </x-form.input-block>
        </div>        
        <div class="submit-section mb-3">
            <button class="btn btn-primary submit-btn" type="submit">{{ __('Submit') }}</button>
        </div>
    </form>
</div>
