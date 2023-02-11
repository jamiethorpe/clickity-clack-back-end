<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Actions\LoginUser;
use App\Actions\UpdateUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            if (!$request->input('id')) {
                $user = CreateUser::run(...$request->only(['name', 'email', 'password']));
            } else {
                $user = User::find($request->input('id'));
                UpdateUser::run($user, $request->only(['name', 'email', 'password']));
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        $token = LoginUser::run($user->email, $request->input('password'));

        return response()->json([
            'token' => $token,
            'name' => $user->name,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $token = LoginUser::run(...$request->only(['email', 'password']));

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User has been logged out',
        ]);
    }
}
