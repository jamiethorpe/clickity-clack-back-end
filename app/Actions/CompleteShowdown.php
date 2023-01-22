<?php

namespace App\Actions;

use App\Events\ShowdownCompleted;
use App\Models\Showdown;
use Lorisleiva\Actions\Concerns\AsAction;

class CompleteShowdown
{
    use AsAction;

    /**
     * @param Showdown $showdown
     * @return Showdown
     */
    public function handle(Showdown $showdown): Showdown
    {
        $winner = $showdown->rounds->groupBy('user_id')->sortBy('count')
            ->first()->pluck('user_id')->first();

        $showdown->user_id = $winner->id;
        $showdown->save();

        ShowdownCompleted::dispatch($showdown);

        return $showdown;
    }
}
