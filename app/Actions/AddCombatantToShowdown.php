<?php

namespace App\Actions;

use App\Events\CombatantAddedToShowdown;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class AddCombatantToShowdown
{
    use AsAction;

    public function handle(Showdown $showdown, User $combatant): Showdown
    {
        Log::info("Adding combatant {$combatant->id} to showdown {$showdown->id}");

        $showdown->combatants()->attach($combatant);

        if ($showdown->refresh()->combatants()->count() === 2) {
            // TODO - this could be a job
            CreateRounds::run($showdown);
        }

        CombatantAddedToShowdown::dispatch($combatant, $showdown);

        Log::info("Combatant {$combatant->id} added to showdown {$showdown->id}");

        return $showdown;
    }
}
