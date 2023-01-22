<?php

namespace App\Actions;

use App\Models\Showdown;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateShowdown
{
    use AsAction;

    public function handle()
    {
        // TODO - dispatch job that cancels showdown and emits event if not completed in X time
        return Showdown::create();
    }
}
