<label {!! $attributes->merge(['class' => 'col-form-label']) !!}>
    {{ $slot }}
    @if(!empty($required) || !empty($mandatory))
        <span class="text-danger">*</span>
    @endif
</label>
