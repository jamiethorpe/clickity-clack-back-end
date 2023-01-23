<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function winLoss(Request $request, User $user)
    {
        return response()->json([
            'wins' => $user->wins()->count(),
            'losses' => $user->losses()->count(),
            'winRate' => $user->winRate(),
        ]);
    }
}
