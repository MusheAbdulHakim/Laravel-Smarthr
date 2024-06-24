@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="invalid-feedback" role="alert">{{ $error }}</div>
    @endforeach
@endif
