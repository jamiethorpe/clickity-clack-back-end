<?php

namespace App\Actions;

use App\Events\ShowdownReady;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class AddCombatantToShowdown
{
    use AsAction;

    public function handle(Showdown $showdown, User $combatant)
    {
        // TODO - ensure combatant is not already in the showdown
        $showdown->combatants()->attach($combatant);

        if ($showdown->refresh()->combatants()->count() === 2) {
            // TODO - this could be a job
            CreateRounds::run($showdown);
        }

        return $showdown;
    }
}
