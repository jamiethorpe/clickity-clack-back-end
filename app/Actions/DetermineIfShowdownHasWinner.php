<?php

namespace App\Actions;

use App\Models\Showdown;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class DetermineIfShowdownHasWinner
{
    use AsAction;

    public function handle(Showdown $showdown): ?User
    {
        $currentLeaderRounds = $showdown->rounds->groupBy('user_id')->sortDesc()->first();

        return $currentLeaderRounds->count() >= (int)round((config('showdown.rounds') / 2))
            ? $currentLeaderRounds->first()->winner
            : null;
    }
}
