<?php

namespace App\Actions;

use App\Models\Showdown;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class DetermineIfShowdownHasWinner
{
    use AsAction;

    public function handle(Showdown $showdown): ?User
    {
        Log::info("Determining if showdown {$showdown->id} has a winner");

        $currentLeaderRounds = $showdown->rounds->groupBy('user_id')->sortDesc()->first();

        $winner = $currentLeaderRounds->count() >= (int)round((config('showdown.rounds') / 2))
            ? $currentLeaderRounds->first()->winner
            : null;

        Log::info("Showdown {$showdown->id} has a winner: " . ($winner ? $winner->id : 'no'));

        return $winner;
    }
}
