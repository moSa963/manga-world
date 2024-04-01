<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function register(RegisterRequest $request)
    {
        $user = $request->register();

        return response()->json([
            "data" => [
                "user" => $user,
                'token' => $user->createToken('web')->plainTextToken,
            ]
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            abort(400, 'Username or Password is wrong.');
        }

        return response()->json([
            "data" => [
                "user" => $user,
                'token' => $user->createToken('web')->plainTextToken,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
