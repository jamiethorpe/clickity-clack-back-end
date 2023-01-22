<?php

namespace App\Http\Controllers;

use App\Actions\CreatePerformance;
use App\Models\Round;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PerformanceController extends Controller
{
    public function store(Request $request, Showdown $showdown, Round $round)
    {
        $user = User::findOrFail($request->input('userId'));

        $performance = CreatePerformance::run(
            $round,
            $user,
            $request->input('duration')
        );

        return response()->json($performance);
    }
}
