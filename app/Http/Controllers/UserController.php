<?php

namespace App\Http\Controllers;

use App\Mail\AddUserMail;
use App\Models\Email;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    protected $userDetails;

    public function __construct()
    {
        // Retrieve user details from session and store it in $userDetails
        $this->userDetails = Session::get('user_details');
    }
    // ================================================== Crew =====================================================================

    // get user privileges
    public function getUserPrivileges($id)
    {
        $user = User::findOrFail($id);

        $user->user_privileges = json_decode($user->user_privileges);

        return response()->json(['success' => true, 'data' => $user],  200);
    }
    // get user privileges

    // add user privileges
    public function addUserPrivileges(Request $request, $id)
    {
        try {
            $user = User::find($id);

            // Use the "privileges" key in the request to get the nested array
            $selectedPrivileges = $request->input('privileges', []);

            $user->user_privileges = json_encode($selectedPrivileges);

            $user->save();

            return response()->json(['success' => true, 'message' => 'Privileges added to The User'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // add user privileges

    // get user on privileges
    public function getUserOnPrivileges($id)
    {
        try {
            $user = User::where('id', $id)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found!'], 404);
            } elseif ($user->user_role == 'admin') {
                return response()->json(['success' => false, 'message' => 'Cannot set privileges of this User!'], 400);
            } else {

                $user->user_privileges = json_decode($user->user_privileges, true);

                return view('privileges', ['user' => $user, 'user_details' => $this->userDetails]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get user on privileges

    // ================================================== Crew =====================================================================

    // ================================================== Crew =====================================================================

    // delete crew
    public  function  deleteCrew($id)
    {
        try {
            $user  = User::where('id', $id)->first();
            if (!$user) {
                return response()->json(['success' => false, 'message'  => 'no Crew found'], 404);
            }

            $user->delete();

            return response()->json(['success' => true, 'message' => 'Crew deleted  successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete crew
    // get crew departement on crew
    public function getDepartementOnCrew()
    {
        $crew = User::where('user_role', 'crew')->get();
        $departement  = UserRole::select('departement')->get();

        return view('crew', ['departements' => $departement, 'crew' => $crew, 'user_details' => $this->userDetails]);
    }
    // get crew departement on crew

    // add crew
    public function addCrew(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData  =  $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'departement' => 'required|string',
                'rate' => 'nullable|numeric',
                'teamNumber' => 'required|numeric',
                'address' => 'required|string',
                'upload_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $users = User::create([
                'name' => $validatedData['firstName'],
                'last_name' => $validatedData['lastName'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'user_role' => 'crew',
                'address' => $validatedData['address'],
                'departement' => $validatedData['departement'],
                'rating' => $validatedData['rate'],
                'team_number' => $validatedData['teamNumber'],
                'added_user_id' => $userDetails['id'],
            ]);

            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/user_images', $imageName); // Adjust storage path as needed
                $users->user_image = 'storage/user_images/' . $imageName;
            }

            $users->save();

            return response()->json(['success' => true, 'message' => 'Crew added successfully!'], 200);
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add crew

    // ================================================== Crew =====================================================================

    // ================================================== Users =====================================================================
    // delete Users
    public function  deleteUser($id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                return response(['success' => false, 'message' => 'User not found!'], 404);
            } elseif ($user == 'admin') {
                return response(['success' => false, 'message' => 'User cannot be deleted!'], 400);
            } else {
                $user->delete();
                return response(['success' => true, 'message' => 'User deleted!'], 200);
            }
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete Users
    // get users with roles
    public function getUsersWithRoles()
    {

        $userDetails = session('user_details');

        if ($userDetails['user_role'] == 'admin') {

            $users = User::where('user_role', '<>', 'crew')->get();
            $userRoles = UserRole::get();

            return view('users', ['users' => $users, 'user_roles' => $userRoles, 'user_details' => $userDetails]);
        } else {
            return response()->json(['success' => false, 'message' => 'You do not have access to this url!'], 401);
        }
    }
    // get users with roles
    //add users
    public function addUsers(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'role' => 'required|string',
                'address' => 'required|string',
                'upload_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $password = rand();

            $emailData = [
                'email' => $validatedData['email'],
                'password' => $password,
            ];

            $mail = new AddUserMail($emailData);
            Mail::to($validatedData['email'])->send($mail);

            $users = User::create([
                'name' => $validatedData['firstName'],
                'last_name' => $validatedData['lastName'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'user_role' => $validatedData['role'],
                'address' => $validatedData['address'],
                'password' => md5($password),
                'added_user_id' => $userDetails['id'],
            ]);

            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/user_images', $imageName); // Adjust storage path as needed
                $users->user_image = 'storage/user_images/' . $imageName;
            }


            $users->save();

            return response()->json(['success' => true, 'message' => 'User added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    //add users
    // del user role
    public function deleteUserRole(Request $request, $id)
    {
        try {

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
    // del user role
    // add user role
    public function addUserRole(Request $request)
    {
        try {


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

        if ($userDetails['user_role'] == 'admin') {
            $userRole = UserRole::get();
            return view('user_roles', ['user_roles' => $userRole, 'user_details' => $this->userDetails]);
        } else {
            return response()->json(['success' => false, 'message' => 'You do not have access to this url!'], 401);
        }
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
            $userRole = $user->user_role;
            // if ($userRole != 'admin') {
            //     // User role is not allowed to login
            //     return response()->json(['success' => false, 'message' => 'User not  allowed to login!'], 401);
            // }

            // Create a session for the user
            session(['user_details' => [
                'token' => $token, // Set token value if needed
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'user_role' => $user->user_role,
                'user_image' => $user->user_image,
                'phone' => $user->phone,
                'address' => $user->address,
                'departement' => $user->departement,
                'rating' => $user->rating,
                'team_number' => $user->team_number,
                'user_privileges' => json_decode($user->user_privileges),
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
}
