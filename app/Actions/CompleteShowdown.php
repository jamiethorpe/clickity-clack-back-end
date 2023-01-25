<?php

namespace App\Actions;

use App\Events\ShowdownCompleted;
use App\Models\Showdown;
use App\Models\User;
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
        $showdown->user_id = $winner->id;
        $showdown->completed_at = now();
        $showdown->save();

        ShowdownCompleted::dispatch($showdown);

        return $showdown;
    }
}
