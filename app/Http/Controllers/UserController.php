<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'user registed successfully',
            'user' => $user
        ], 201);
    }
    function login(Request $request)
    {
        $task = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json([
                'message' => 'invalid email or password'
            ], 401);
        $user = User::where('email', $request->email)->FirstorFail();
        $token = $user->createToken('Auth_Token')->plainTextToken;
        return response()->json([
            'message' => 'login successfully',
            'Token' => $token
        ], 200);
    }
    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout successfully'
        ], 200);
    }

    function getProfile($id)
    {
        $profile = User::find($id)->profile;
        return response()->json($profile, 200);
    }
    function getUserTask($id)
    {
        $tasks = User::find($id)->tasks;
        return response()->json($tasks, 200);
    }
}
