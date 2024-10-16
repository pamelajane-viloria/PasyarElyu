<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    // Login user method
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Validate the credentials
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user(); // Fetches the authenticated user
            return response()->json(['message' => 'Login successful!', 'user' => $user], 200);
        }

        return response()->json(['message' => 'Invalid username or password!'], 401);
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out']);
    }
}
