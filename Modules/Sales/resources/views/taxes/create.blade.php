<div class="modal-body">
    <form action="{{ route('taxes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Enter tax name" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Percentage') }}</x-form.label>
            <x-form.input type="text" name="percentage" placeholder="Enter percentage: 10" />
        </x-form.input-block>
        <x-form.input-block>
           <select name="status" class="form-control">
            <option value="1">{{ __('Active') }}</option>
            <option value="0">{{ __('InActive') }}</option>
           </select>
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
