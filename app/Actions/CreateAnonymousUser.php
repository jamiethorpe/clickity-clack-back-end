<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAnonymousUser
{
    use AsAction;

    public function handle()
    {
        Log::info("Creating anonymous user");

        $user = User::create();

        Log::info("Anonymous user created: {$user->id}");

        return $user;
    }
}
