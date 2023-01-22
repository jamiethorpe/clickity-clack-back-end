<?php

namespace App\Listeners;

use App\Actions\CompleteRound;
use App\Events\PerformanceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandlePerformanceCreated
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
     * @param  \App\Events\PerformanceCreated  $event
     * @return void
     */
    public function handle(PerformanceCreated $event)
    {
        if ($event->performance->round->performances()->count() !== 2) {
            return;
        }

        CompleteRound::run($event->performance->round);
    }
}
