<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ================================================== Users =====================================================================
    public function deleteUserRole(Request $request, $id)
    {
        try {
            $userDetails = session('user_details');
            $userRole = UserRole::where('user_role_id', $id)->first();

            if (!$userRole) {
                return response()->json(['success' => false, 'message' => 'No user role found!'], 404);
            }

            $userRole->delete();

            return response()->json(['success' => true, 'message' => 'User role deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add user role
    public function addUserRole(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData =  $request->validate([
                'departement'  => 'required|string',
                'role' => 'required|string',
            ]);
            $userRole = UserRole::create([
                'departement' => $validatedData['departement'],
                'role' =>  $validatedData['role'],
            ]);
            // return redirect()->back()->with(['success'  => true, 'mwssage' => 'data added'],  200);

            return response()->json(['success'  => true, 'message' => 'data added'],  200);
        } catch (\Exception $e) {
            return  response()->json(['success' => false, 'message' =>  $e->getMessage()], 400);
        }
    }
    // add user role
    // get user role

    public function getUserRole()
    {

        $userDetails = session('user_details');
        $userRole = UserRole::get();
        return view('user_roles', ['user_roles' => $userRole, 'user_details' => $userDetails]);
    }
    public function getUsers()
    {

        $userDetails = session('user_details');
        $userRole = UserRole::get();
        return view('users', ['user_roles' => $userRole, 'user_details' => $userDetails]);
    }
    // get user role
    // ================================================== Users =====================================================================
    // ================================================== authentication =====================================================================
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

            return response()->json(['success' => true, 'message' => 'Login successful', 'user_details' => session('user_details')]);
        } else {
            // Authentication failed
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_details');
        $request->session()->regenerate();

        return redirect('/');
    }
    // ================================================== authentication =====================================================================


    //add users

    public function addUsers(Request $request)
    {
        try {
            $userDetails = session('user_details');
            $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'role' => 'required|string',
                'address' => 'required|string',
            ]);
            $users = User::create([
                'name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'user_role' => $validated['role'],
                'address' => $validated['address'],
            ]);
            return response()->json(['sucess' => true, 'message' => 'date add'], 200);
        } catch (\Exception $eror) {
            return response()->json(['sucess' => false, 'message' => $eror->getMessage()], 404);
        }
    }
}
