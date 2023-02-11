<?php

namespace App\Http\Controllers;

use App\Actions\CreatePasswordReset;
use App\Http\Requests\SendPasswordResetRequest;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function send(SendPasswordResetRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (null !== $user) {
            $passwordReset = CreatePasswordReset::run($user->email);
            Mail::to($user->email)->queue(new PasswordResetMail($passwordReset));
        }

        return response()->json();
    }

    public function updatePassword()
    {

    }
}
