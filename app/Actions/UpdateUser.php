<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUser
{
    use AsAction;

    public function handle(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
