<?php

namespace App\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAnonymousUser
{
    use AsAction;

    public function handle()
    {
        return User::create();
    }
}
