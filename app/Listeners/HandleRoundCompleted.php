<?php

namespace App\Listeners;

use App\Actions\CompleteShowdown;
use App\Events\RoundCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleRoundCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RoundCompleted $event)
    {
        if ($event->round->showdown->rounds()->completed()->count() !== config('showdown.rounds')) {
            return;
        }

        CompleteShowdown::run($event->round->showdown);
    }
}
