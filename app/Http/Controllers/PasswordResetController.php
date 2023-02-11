<?php

namespace App\Http\Controllers;

use App\Actions\CreatePasswordReset;
use App\Http\Requests\SendPasswordResetRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\PasswordResetMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function send(SendPasswordResetRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (null !== $user) {
            // TODO - delete old password resets
            $passwordReset = CreatePasswordReset::run($user->email);
            Mail::to($user->email)->queue(new PasswordResetMail($passwordReset));
        }

        return response()->json(['message' => 'Password reset email sent.']);
    }

    public function update(UpdatePasswordRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->input('token'))->first();

        $user = User::where('email', $passwordReset->email)->first();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $passwordReset->delete();

        return response()->json(['message' => 'Password updated.']);
    }
}
