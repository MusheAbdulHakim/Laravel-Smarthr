<div class="modal-body">
    <form action="{{ route('departments.update', $department->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-form.input-block>
            <x-form.label>{{ __('Name') }}</x-form.label>
            <x-form.input type="text" name="name" placeholder="Enter department" value="{{ $department->name }}" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Location') }}</x-form.label>
            <x-form.input type="text" name="location" placeholder="Enter department location" value="{{ $department->location }}" />
        </x-form.input-block>
        <x-form.input-block>
            <x-form.label>{{ __('Description') }}</x-form.label>
            <x-form.textarea name="description">{{ $department->description }}</x-form.textarea>
        </x-form.input-block>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
