<?php

namespace App\Actions;

use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePasswordReset
{
    use AsAction;

    public function handle(string $email): PasswordReset
    {
        return PasswordReset::create([
            'email' => $email,
            'token' => $this->createToken(),
        ]);
    }

    /**
     * @return string
     */
    private function createToken(): string
    {
        do {
            //generate a random string
            $token = Str::random(40);
        } //check if the token already exists and if it does, try again
        while (PasswordReset::where('token', $token)->first());

        return $token;
    }
}
