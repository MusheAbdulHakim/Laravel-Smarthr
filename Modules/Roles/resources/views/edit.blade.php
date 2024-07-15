<div class="modal-body">
    <form method="post" action="{{route('roles.update')}}">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" value="{{ $role->id }}">
        <div class="form-group">
            <label>{{ __('Role Name') }} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" id="edit_name" value="{{ $role->name }}">
        </div>
        <div class="submit-section mb-1">
            <button class="btn btn-primary submit-btn">Save</button>
        </div>
    </form>
</div>