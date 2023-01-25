<?php

namespace App\Actions;

use App\Events\RoundCompleted;
use App\Models\Round;
use Lorisleiva\Actions\Concerns\AsAction;

class CompleteRound
{
    use AsAction;

    public function handle(Round $round)
    {
        // Determine the round winner
        $round->user_id = $round->performances->sortBy('duration')->first()->user_id;
        // TODO - handle possible ties
        $round->save();

        RoundCompleted::dispatch($round);

        return $round;
    }
}
