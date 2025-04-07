<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'max:50']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        event(new Registered($user));

        $token = $user->createToken($request->name);

        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function createToken(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    }

    public function loginUser(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'exists:' . User::class],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['message' => 'Username or Password is incorrect!'];
        }

        $token = $user->createToken($user->name);

        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function logoutUser(Request $request)
    {
        $request->user()->tokens()->delete();

        return ['message' => 'User is logged out!'];
    }
}
