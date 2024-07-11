<?php

use Illuminate\Support\Facades\Broadcast;
use RTippin\Messenger\Broadcasting\Channels\CallChannel;
use RTippin\Messenger\Broadcasting\Channels\ThreadChannel;
use RTippin\Messenger\Broadcasting\Channels\ProviderChannel;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('messenger.call.{call}.thread.{thread}', CallChannel::class); // Presence
Broadcast::channel('messenger.thread.{thread}', ThreadChannel::class); // Presence
Broadcast::channel('messenger.{alias}.{id}', ProviderChannel::class); // Private