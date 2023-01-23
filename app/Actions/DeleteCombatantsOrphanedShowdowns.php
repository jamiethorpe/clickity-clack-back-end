<?php

namespace App\Actions;

use App\Events\CombatantAddedToShowdown;
use App\Models\Showdown;
use App\Models\User;
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
        $combatant->showdowns()->whereNot('id', $showdown->id)
            ->whereNull('user_id')
            ->delete();
    }

    public function asListener(CombatantAddedToShowdown $event): void
    {
        $this->handle($event->combatant, $event->showdown);
    }
}
