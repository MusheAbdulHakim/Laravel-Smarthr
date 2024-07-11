<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Janus Client Configurations
    |--------------------------------------------------------------------------
    |
    */
    'server_endpoint' => env('JANUS_SERVER_ENDPOINT'),
    'admin_server_endpoint' => env('JANUS_ADMIN_SERVER_ENDPOINT'),
    'verify_ssl' => env('JANUS_VERIFY_SSL', true),
    'debug' => env('JANUS_DEBUG', true),
    'admin_secret' => env('JANUS_ADMIN_SECRET'),
    'api_secret' => env('JANUS_API_SECRET'),
    'video_room_secret' => env('JANUS_VIDEO_ROOM_SECRET'),
];
