@php
    $error = $errors->has($name) ? 'is-invalid' : '';
    $inputId = random_str(5);
    if (!empty($id) && isset($id)) {
        $inputId = $id;
    }
@endphp
<input type="hidden" name="country_code">
<input type="hidden" name="country_name">
<input type="hidden" name="dial_code">
<input id="{{ $inputId }}" {!! $attributes->merge(['class' => 'form-control ' . $error]) !!}>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
<script>
    $(document).ready(function() {
        let input = document.querySelector("#{{ $inputId }}")
        let iti = intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us"));
            },
        });
        input.addEventListener("countrychange", function() {
            let data = iti.getSelectedCountryData()
            $('input[name="dial_code"]').val(data.dialCode)
            $('input[name="country_code"]').val(data.iso2)
            $('input[name="country_name"]').val(data.name)
        });
    })
</script>
