<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['users'] = User::join('roles', 'roles.id', '=', 'users.role_id')->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'roles.name AS role_name')->paginate(10);

        if ($request->ajax()) {
            return view('pages.admin.users.partials.usersTable', $data);
        }

        return view('pages.admin.users.usersView', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::all();
        return view('pages.admin.users.createUserForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
            'lastName' => 'required|regex:/^[A-Z][a-z]{3,24}$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/|confirmed',
            'role' => 'required|in:1,2',
        ],
            [
                'firstName.required' => 'First Name is required',
                'firstName.regex' => 'First Name must start with capital letter and contain only letters,minimum 3',
                'lastName.required' => 'Last Name is required',
                'lastName.regex' => 'Last Name must start with capital letter and contain only letters,minimum 4',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'email.unique' => 'Email already in use',
                'password.required' => 'Password is required',
                'password.regex' => 'Password must contain at least one number and one uppercase and lowercase letter,minimum 8 characters',
                'password.confirmed' => 'Password does not matched',
                'role.required' => 'Role is required',
                'role.in' => 'Role must be selected form dropdown list',
            ]);

        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        logActivity('New user created by admin','New user id : '.$user->id);

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.password', 'roles.id AS role_id')->find($id);
        $data['roles'] = Role::all();
        return view('pages.admin.users.editUserForm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstName' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
            'lastName' => 'required|regex:/^[A-Z][a-z]{3,24}$/',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/',
            'role' => 'required|in:1,2',
        ], [
            'firstName.required' => 'First Name is required',
            'firstName.regex' => 'First Name must start with capital letter and contain only letters,minimum 3',
            'lastName.required' => 'Last Name is required',
            'lastName.regex' => 'Last Name must start with capital letter and contain only letters,minimum 4',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already in use',
            'password.regex' => 'Password must contain at least one number and one uppercase and lowercase letter,minimum 8 characters',
            'password.confirmed' => 'Password does not matched'
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->role_id = $request->role;
        $user->save();

        logActivity('User updated by admin','User id : '.$user->id);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        logActivity('User deleted by admin','User id : '.$user->id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
