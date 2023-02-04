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

        Log::info("Round {$round->id} completed");

        if ($winner = DetermineIfShowdownHasWinner::run($round->refresh()->showdown)) {
            CompleteShowdown::run($round->showdown, $winner);
        } else {
            RoundCompleted::dispatch($round);
        }

        return $round;
    }
}
