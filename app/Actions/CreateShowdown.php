<?php

namespace App\Actions;

use App\Models\Showdown;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateShowdown
{
    use AsAction;

    public function handle()
    {
        Log::info("Creating showdown");

        // TODO - dispatch job that cancels showdown and emits event if not completed in X time
        $showdown = Showdown::create();

        Log::info("Showdown created: {$showdown->id}");

        return $showdown;
    }
}
