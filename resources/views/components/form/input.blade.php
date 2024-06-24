@php
    $error = $errors->has($name) ? 'is-invalid' : '';
@endphp
<input {!! $attributes->merge(['class' => "form-control ". $error]) !!}>
@error($name)
<div class="invalid-feedback">
   {{ $message }}
</div>
@enderror
