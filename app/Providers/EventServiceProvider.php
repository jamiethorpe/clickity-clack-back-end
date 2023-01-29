<?php

namespace App\Providers;

use App\Actions\DeleteCombatantsOrphanedShowdowns;
use App\Events\CombatantAddedToShowdown;
use App\Events\PerformanceCreated;
use App\Events\RoundCompleted;
use App\Listeners\HandlePerformanceCreated;
use App\Listeners\HandleRoundCompleted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CombatantAddedToShowdown::class => [
            DeleteCombatantsOrphanedShowdowns::class
        ],

        PerformanceCreated::class => [
            HandlePerformanceCreated::class,
        ],

        RoundCompleted::class => [
            HandleRoundCompleted::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
