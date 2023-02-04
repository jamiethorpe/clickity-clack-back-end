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
     * @return \Illuminate\Http\JsonResponse
     */
    public function channelVacated(PusherChannelVacatedRequest $request)
    {
        $events = $request->input('events');

        for ($i = 0; $i < count($events); $i++) {
            if ($events[$i]['name'] !== 'channel_vacated') {
                continue;
            }

            $showdownId = explode('.', $events[$i]['channel'])[1];

            $showdown = Showdown::find($showdownId);
            if ($showdown && $showdown->combatants()->count() < 2) {
                $showdown->delete();
            }
        }

        return response()->json(['success' => true], 200);
    }
}
