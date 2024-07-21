<div class="modal-body">
    <form action="{{ route('taxes.update', $tax->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Enter tax name" value="{{ $tax->name }}" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Percentage') }}</x-form.label>
            <x-form.input type="text" name="percentage" placeholder="Enter percentage: 10" value="{{ $tax->percentage }}" />
        </x-form.input-block>
        <x-form.input-block>
           <select name="status" class="form-control">
            <option {{ $tax->active == true ? 'selected': '' }} value="1">{{ __('Active') }}</option>
            <option {{ $tax->active == false ? 'selected': '' }} value="0">{{ __('InActive') }}</option>
           </select>
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
