<?php

namespace App\Actions;

use App\Events\CombatantAddedToShowdown;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCombatantsOrphanedShowdowns
{
    use AsAction;

    /**
     * Delete any other showdowns where the combatant is the only combatant
     * @param User $combatant
     * @param Showdown $showdown
     * @return void
     */
    public function handle(User $combatant, Showdown $showdown): void
    {
        Log::info("Deleting orphaned showdowns for combatant {$combatant->id}");

        $showdownsIds = Showdown::whereNot('id', $showdown->id)
            ->includingCombatant($combatant)->waitingForOpponent()->get()->pluck('id');

        $count = Showdown::destroy($showdownsIds);
        
        Log::info("Deleted $count orphaned showdowns for combatant {$combatant->id}");
    }

    public function asListener(CombatantAddedToShowdown $event): void
    {
        $this->handle($event->combatant, $event->showdown);
    }
}
