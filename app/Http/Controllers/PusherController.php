<?php

namespace App\Http\Controllers;

use App\Http\Requests\PusherChannelVacatedRequest;
use App\Models\Showdown;

class PusherController extends Controller
{
    /**
     * Delete the showdown if the only user has left the channel.
     *
     * @param PusherChannelVacatedRequest $request
     * @return void
     */
    public function channelVacated(PusherChannelVacatedRequest $request)
    {
        $showdownId = explode('.', $request->input('channel'))[1];
        $showdown = Showdown::findOrFail($showdownId);

        if (!$showdown) {
            abort(403);
        }

        if ($showdown->combatants()->count() < 2) {
            $showdown->delete();
        }
    }
}
