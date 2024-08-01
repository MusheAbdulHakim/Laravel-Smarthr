<div class="modal-body">
    <form action="{{ route('assets.update', $asset->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset Name') }}</x-form.label>
                    <x-form.input type="text" name="name" placeholder="{{ __('Enter Asset Name') }}" value="{{ $asset->name }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset Id') }}</x-form.label>
                    <x-form.input type="text" name="ast_id" value="{{ $asset->ast_id }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Purchase Date') }}</x-form.label>
                    <x-form.input type="text" name="purchase_date" class="datepicker" value="{{ $asset->purchase_date }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Purchase From') }}</x-form.label>
                    <x-form.input type="text" name="purchase_from" value="{{ $asset->purchase_from }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Manufacturer') }}</x-form.label>
                    <x-form.input type="text" name="manufacturer" value="{{ $asset->manufacturer }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Model') }}</x-form.label>
                    <x-form.input type="text" name="model" value="{{ $asset->model }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Serial Number') }}</x-form.label>
                    <x-form.input type="text" name="serial_no" value="{{ $asset->serial_no }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Brand') }}</x-form.label>
                    <x-form.input type="text" name="brand" placeholder="Dell" value="{{ $asset->brand }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Supplier') }}</x-form.label>
                    <x-form.input type="text" name="supplier" value="{{ $asset->supplier }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Condition') }}</x-form.label>
                    <x-form.input type="text" name="condition" value="{{ $asset->ast_condition }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Warranty') }}</x-form.label>
                    <x-form.input type="integer" name="warranty" placeholder="{{ __('In months') }}" value="{{ $asset->warranty }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Warranty End') }}</x-form.label>
                    <x-form.input type="text" name="warranty_end" class="datepicker" value="{{ $asset->warranty_end }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Cost') }}</x-form.label>
                    <x-form.input type="text" name="cost" value="{{$asset->cost}}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Asset user') }}</x-form.label>
                    <select name="user" class="form-control select">
                        @foreach ($users as $user)
                            <option {{ $asset->user_id == $user->id ? 'selected': '' }} value="{{$user->id}}">{{$user->firstname.' '.$user->lastname}}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Status') }}</x-form.label>
                    <select name="status" class="form-control">
                        <option {{ $asset->status == 'approved' ? 'selected': '' }} value="approved">Approved</option>
                        <option {{ $asset->status == 'pending' ? 'selected': '' }} value="pending">Pending</option>
                        <option {{ $asset->status == 'returned' ? 'selected': '' }} value="returned">Returned</option>
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
                <x-form.textarea name="description">{{ $asset->description }}</x-form.textarea>
            </x-form.input-block>
        </div>    
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
