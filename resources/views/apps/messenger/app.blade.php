@extends('layouts.app')

@section('vendor-styles')
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="FS">
<meta name="apple-mobile-web-app-title" content="FS">
<meta name="msapplication-starturl" content="/">
<meta name="title" content="Messenger App">
@auth
{{-- <link id="main_css" href="{{ asset(mix(messenger()->getProviderMessenger()->dark_mode ? 'dark.css' : 'app.css', 'vendor/messenger')) }}" rel="stylesheet"> --}}
@endauth
@vite("resources/js/messenger/css/style.scss")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-toolkit@8.0.0/extras/css/joypixels.min.css"/>
@stack('css')
@endsection

@section('page-content')
<!-- Chat Main Row -->
<div class="chat-main-row">
    <!-- Chat Main Wrapper -->
    <div id="FS_main_section" class="chat-main-wrapper">
        <div class="col-lg-9 message-view task-view">
            @yield('chat-page-content')
        </div>
    </div>
    <!-- /Chat Main Wrapper -->
</div>
<!-- /Chat Main Row -->
@stack('js')

@endsection

@section('vendor-scripts')
@vite([
    "resources/js/datatables.js",
    "resources/js/messenger/app.js"
])
@if(auth()->check())
<script src="https://cdn.jsdelivr.net/npm/emoji-toolkit@6.5.1/lib/js/joypixels.min.js"></script>
@endif
@stack('special-js')
<script type="module">
    $(document).ready(function(){
        $('html').attr('data-sidebar-size','sm-hover')
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        Messenger.init({
            load : {
                NotifyManager : {
                    notify_sound : {{messenger()->getProviderMessenger()->notify_sound ? 'true' : 'false'}},
                    message_popups : {{messenger()->getProviderMessenger()->message_popups ? 'true' : 'false'}},
                    message_sound : {{messenger()->getProviderMessenger()->message_sound ? 'true' : 'false'}},
                    call_ringtone_sound : {{messenger()->getProviderMessenger()->call_ringtone_sound ? 'true' : 'false'}},
                },
                @stack('Messenger-load')
            },
            provider : {
                id : {{messenger()->getProvider()->getKey()}},
                model : '{{messenger()->getProvider()->getMorphClass()}}',
                alias : '{{messenger()->getProviderAlias()}}',
                name : '{{ messenger()->getProvider()->getProviderName()}}',
                slug : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
                avatar_md : '{{ messenger()->getProvider()->getProviderAvatarRoute('md')}}',
                avatar_sm : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
            },
            common : {
                app_name : '{{config('app.name')}}',
                api_endpoint : '{{messenger()->getApiEndpoint()}}',
                web_endpoint : '{{route("messenger.index")}}',
                socket_endpoint : '{{env("REVERB_HOST")}}',
                socket_auth_endpoint : "env('MESSENGER_SOCKET_AUTH_ENDPOINT', '/api/broadcasting/auth')",
                socket_key : '{{env("REVERB_APP_KEY")}}',
                socket_port : '{{env("REVERB_PORT")}}',
                socket_tls : 'false',
                socket_cluster : '',
                socket_pusher : 'false',
                dark_mode : {{messenger()->getProviderMessenger()->dark_mode ? 'true' :  'false'}},
            },
            modules : {
                @stack('Messenger-modules')
            },
            @stack('Messenger-call')
        }, '{{config('app.env')}}');
    })
</script>
@endsection

