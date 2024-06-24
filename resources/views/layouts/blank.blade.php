<!DOCTYPE html>
<html lang="{{ !empty(LocaleSettings('lang')) ? LocaleSettings('lang') : 'en' }}"
    data-layout="{{ !empty(Theme('layout')) ? Theme('layout') : 'vertical' }}"
    data-topbar="{{ !empty(Theme('topbar_color')) ? Theme('topbar_color') : 'default' }}" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="{{ asset('assets/img/laptop.png') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <title>{{ $pageTitle ?? '' }} - {{ !empty(Theme('name')) ? Theme('name') : config('app.name') }}</title>
    @include('partials.styles')
</head>

<body @isset($bodyClass) class="{{ $bodyClass }}" @endisset>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @yield('content')
    </div>
    <!-- /Main Wrapper -->
    @include('partials.scripts')
    @yield('modals')
</body>

</html>
