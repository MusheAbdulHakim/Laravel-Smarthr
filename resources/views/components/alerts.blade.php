@if (Session::has('alert')) 
    @php
        $type = Session::get('alert-type', '');
    @endphp
    @switch ($type) 
        @case ('info'):
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Note! </strong> <span class="text-black">{{ Session::get('alert') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @break;
        @case ('success'):
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong> <span class="text-black">{{ Session::get('alert') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @break;
        @case ('warning'):
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning! </strong> <span class="text-black">{{ Session::get('alert') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @break;
       @case ('error'):
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong> <span class="text-black">{{ Session::get('alert') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            @break;
    @endswitch
@endif