<div class="modal-body">
    <form action="{{ route('budget.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.input-block>
            <x-form.label required>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name"/>
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
