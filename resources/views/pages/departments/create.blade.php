<div class="modal-body">
    <form action="{{ route('departments.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Enter department" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Location') }}</x-form.label>
            <x-form.input type="text" name="location" placeholder="Enter department location" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Description') }}</x-form.label>
            <x-form.textarea name="description"></x-form.textarea>
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
