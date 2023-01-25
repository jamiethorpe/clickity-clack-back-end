<?php

namespace App\Listeners;

use App\Actions\CompleteShowdown;
use App\Actions\DetermineIfShowdownHasWinner;
use App\Events\RoundCompleted;

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
     * @param RoundCompleted $event
     * @return void
     */
    public function handle(RoundCompleted $event): void
    {
        if ($winner = DetermineIfShowdownHasWinner::run($event->round->showdown)) {
            CompleteShowdown::run($event->round->showdown, $winner);
        }
    }
}
