<?php

namespace App\Actions;

use App\Events\RoundCompleted;
use App\Models\Round;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CompleteRound
{
    use AsAction;

    public function handle(Round $round)
    {
        Log::info("Completing round {$round->id}");
        // Determine the round winner
        $round->user_id = $round->performances->sortBy('duration')->first()->user_id;
        // TODO - handle possible ties
        $round->save();

        RoundCompleted::dispatch($round);

        Log::info("Round {$round->id} completed");

        return $round;
    }
}
