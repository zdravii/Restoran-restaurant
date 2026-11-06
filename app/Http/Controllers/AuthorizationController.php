<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;

class AuthorizationController extends Controller
{
    public function showRegister()
    {
        return view('pages.authorization.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
            'lastName' => 'required|regex:/^[A-Z][a-z]{3,24}$/',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/|confirmed'
        ], [
            'firstName.required' => 'First Name is required',
            'firstName.regex' => 'First Name must start with capital letter and contain only letters,minimum 3',
            'lastName.required' => 'Last Name is required',
            'lastName.regex' => 'Last Name must start with capital letter and contain only letters,minimum 4',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already in use',
            'password.required' => 'Password is required',
            'password.regex' => 'Password must contain at least one number and one uppercase and lowercase letter,minimum 8 characters',
            'password.confirmed' => 'Password does not matched'
        ]);

        $role = Role::where('name', 'user')->firstOrFail()->id;

        User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role
        ]);

        return redirect()->route('loginForm')->with('message', 'Registration successful!');
    }

    public function showLogin()
    {
        return view('pages.authorization.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User does not exist'])->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Wrong password'])->withInput();
        }
        logActivity('User Logged In',null,$user->id);

        session()->put('user_id', $user->id);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        logActivity('User Logged Out',null,session('user_id'));
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
