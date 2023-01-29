<?php

namespace App\Actions;

use App\Models\Showdown;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateRounds
{
    use AsAction;

    public function handle(Showdown $showdown, int $numberOfRounds = null)
    {
        Log::info("Creating $numberOfRounds rounds for showdown {$showdown->id}");

        $numberOfRounds = $numberOfRounds ?? config('showdown.rounds');

        for ($i = 0; $i < $numberOfRounds; $i++) {
            $showdown->rounds()->create([
                'technique' => CreateTechnique::run(rand(2, 6)),
            ]);
        }

        Log::info("$numberOfRounds rounds created for showdown {$showdown->id}");

        return $showdown->rounds;
    }
}
