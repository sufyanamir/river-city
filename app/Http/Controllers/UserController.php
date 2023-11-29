<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $token = Str::random(60);
        $password = $request->input('password');
        $user = User::where('email', $email)->first();

        if ($user && md5($password) === $user->password) {
            // Check if the user role is 0 or 1
            // $userRole = $user->user_role;
            // if ($userRole != 0 && $userRole != 1) {
            //     // User role is not allowed to login
            //     return response()->json(['error' => 'User role not allowed to login'], 401);
            // }

            // Create a session for the user
            session(['user_details' => [
                'token' => $token, // Set token value if needed
                'name' => $user->name,
                'user_id' => $user->id,
            ]]);

            return response()->json(['success' => 'Login successful', 'user_details' => session('user_details')]);
        } else {
            // Authentication failed
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

}
