<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class CreateTechnique
{
    use AsAction;

    public function handle(int $numberOfWords)
    {
        return fake()->words($numberOfWords, true);
    }
}
