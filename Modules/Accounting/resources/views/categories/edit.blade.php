<div class="modal-body">
    <form action="{{ route('budget.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Enter name" value="{{ $category->name }}" />
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
