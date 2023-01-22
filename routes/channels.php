<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('showdown.{id}.ready', function ($user, $id) {
    return true;
});

Broadcast::channel('showdown.{id}.round.completed', function ($user, $id) {
    return true;
});

Broadcast::channel('showdown.{id}.completed', function ($user, $id) {
    return true;
});
