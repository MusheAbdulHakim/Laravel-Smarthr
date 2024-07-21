<div class="modal-body">
    <form action="{{ route('task-boards.update', $taskBoard->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="project_id" value="{{ $taskBoard->project_id ?? '' }}">
        <div class="row">
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Name') }}</x-form.label>
                    <x-form.input type="text" name="name" value="{{ $taskBoard->name }}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Color') }}</x-form.label>
                    <x-form.input type="color" name="color" value="{{ $taskBoard->color }}" />
                </div>
            </div>                        
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Priority') }}</x-form.label>
                    <x-form.input type="number" name="priority" value="{{ $taskBoard->priority }}" />
                </div>
            </div>                        
        </div>
        <div class="submit-section mb-3">
            <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
        </div>
    </form>
</div>
