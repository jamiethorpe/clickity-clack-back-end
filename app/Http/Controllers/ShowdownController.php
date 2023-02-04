<?php

namespace App\Http\Controllers;

use App\Actions\AddCombatantToShowdown;
use App\Actions\CreateAnonymousUser;
use App\Actions\CreateShowdown;
use App\Events\ShowdownReady;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Http\Request;

class ShowdownController extends Controller
{
    public function join(Request $request, ?string $userId = null)
    {
        if (!$user = User::find($userId)) {
            $user = CreateAnonymousUser::run();
        }

        $showdown = Showdown::notCompleted()
            ->excludingCombatant($user)
            ->withCount('combatants')
            ->having('combatants_count', '<', 2)
            ->first();

        if (!$showdown) {
            $showdown = CreateShowdown::run();
        }

        AddCombatantToShowdown::run($showdown, $user);

        return response()->json([
            'id' => $showdown->id,
            'userId' => $user->id,
            'combatantIds' => $showdown->combatants->pluck('id')->toArray(),
        ]);
    }

    public function confirm(Request $request, Showdown $showdown)
    {
        ShowdownReady::dispatch($showdown);

        return response()->json($showdown);
    }
}
