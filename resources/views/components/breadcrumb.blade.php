<div class="page-header">
    <div class="row {{ $alignment ?? '' }}">
        <div class="{{ $class ?? 'col-sm-12' }}">
            @isset($title)
                <h3 class="page-title">{{ $title }}</h3>
            @endisset
            <ul class="breadcrumb">
                {{ $slot }}
            </ul>
        </div>
        @isset($right)
            {!! $right !!}
        @endisset
    </div>
</div>
