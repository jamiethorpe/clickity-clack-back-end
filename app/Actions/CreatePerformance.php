<?php

namespace App\Actions;

use App\Events\PerformanceCreated;
use App\Models\Round;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePerformance
{
    use AsAction;

    public function handle(Round $round, User $user, int $duration): void
    {
        Log::info("Creating performance for user {$user->id} in round {$round->id}");

        $performance = $round->performances()->create([
            'user_id' => $user->id,
            'duration' => $duration,
        ]);

        PerformanceCreated::dispatch($performance);

        Log::info("Performance created for user {$user->id} in round {$round->id}");
    }
}
