<?php

namespace App\Actions;

use App\Models\Round;
use App\Models\Showdown;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateRounds
{
    use AsAction;

    public function handle(Showdown $showdown, int $numberOfRounds = null)
    {
        $numberOfRounds = $numberOfRounds ?? config('showdown.rounds');

        for ($i = 0; $i < $numberOfRounds; $i++) {
            $showdown->rounds()->create([
                'technique' => CreateTechnique::run(rand(2, 6)),
            ]);
        }

        return $showdown->rounds;
    }
}
