<?php

namespace App\Actions;

use App\Events\ShowdownCompleted;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CompleteShowdown
{
    use AsAction;

    /**
     * @param Showdown $showdown
     * @param User $winner
     * @return Showdown
     */
    public function handle(Showdown $showdown, User $winner): Showdown
    {
        Log::info("Completing showdown {$showdown->id} with winner {$winner->id}");

        $showdown->user_id = $winner->id;
        $showdown->completed_at = now();
        $showdown->save();

        ShowdownCompleted::dispatch($showdown);

        Log::info("Showdown {$showdown->id} completed with winner {$winner->id}");

        return $showdown;
    }
}
