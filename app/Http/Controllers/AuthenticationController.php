<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = CreateUser::run(...$request->only(['name', 'email', 'password']));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        $token = $user->createToken(config('sanctum.tokens.access.name'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'name' => $user->name,
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken(config('sanctum.tokens.access.name'))->plainTextToken;;
            return response()->json(['token' => $token]);
        } else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User has been logged out',
        ]);
    }
}
