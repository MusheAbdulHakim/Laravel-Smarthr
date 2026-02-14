@extends('layouts.app')

@section('sidebar')
    <x-custom-sidebar>
        <ul>
            @foreach ($menuItems as $item)
                @if ($item->hasSubmenu())
                    <x-menu.submenu :item="$item" />
                @else
                    <x-menu.item :item="$item" />
                @endif
            @endforeach
        </ul>
    </x-custom-sidebar>
@endsection

@section('page-content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @yield('page-header-section')
                @yield('page-section')
            </div>
        </div>
    </div>
@endsection
