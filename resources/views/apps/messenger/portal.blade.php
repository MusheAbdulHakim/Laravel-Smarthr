@extends('apps.messenger.messenger')

    @php
        $threadManager = \Illuminate\Support\Facades\Vite::asset('resources/js/messenger/managers/ThreadManager.js');
    @endphp
@switch($mode)
    @case(0)
        @push('Messenger-load')
            ThreadManager : {
                type : 0,
                setup : true,
                online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
                thread_id : '{{$thread_id}}',
                src : "{{ $threadManager }}"
            },
        @endpush
    @break
    @case(3)
        @push('Messenger-load')
            ThreadManager : {
                type : 3,
                online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
                setup : true,
                id : '{{$id}}',
                alias : '{{$alias}}',
                src : "{{ $threadManager }}"
            },
        @endpush
    @break
    @case(5)
        @push('Messenger-load')
            ThreadManager : {
                type : 5,
                online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
                setup : true,
                src : "{{ $threadManager }}"
            },
        @endpush
    @break
@endswitch
@push('Messenger-modules')
    ThreadTemplates : {src : "{{ Vite::asset('resources/js/messenger/templates/ThreadTemplates.js') }}"},
    MessengerSettings : {src : "{{ Vite::asset('resources/js/messenger/modules/MessengerSettings.js') }}"},
    ThreadBots : {src : "{{ Vite::asset('resources/js/messenger/modules/ThreadBots.js') }}"},
    EmojiPicker : {src : "{{ Vite::asset('resources/js/messenger/modules/EmojiPicker.js') }}"},
@endpush
