@if($hint = Arr::get($field, 'hint'))
    <span class="form-text text-muted"> {{ $hint }}</span>
@endif

@if ($errors->has($field['name']))
    <small class="{{ config('app_settings.input_error_feedback_class', 'invalid-feedback') }}">
        {{ $errors->first($field['name']) }}
    </small>
@endif
