<?php

namespace App\Actions;

use App\Events\PerformanceCreated;
use App\Models\Round;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePerformance
{
    use AsAction;

    public function handle(Round $round, User $user, int $duration): void
    {
        $performance = $round->performances()->create([
            'user_id' => $user->id,
            'duration' => $duration,
        ]);

        PerformanceCreated::dispatch($performance);
    }
}
