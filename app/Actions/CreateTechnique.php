<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTechnique
{
    use AsAction;

    public function handle(int $numberOfWords)
    {
        Log::info("Creating technique with $numberOfWords words");

        $technique = fake()->words($numberOfWords, true);

        Log::info("Technique created: $technique");

        return $technique;
    }
}
