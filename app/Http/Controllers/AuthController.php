<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the student after registration
        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard');
    }

    // Login method
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid student credentials.',
        ]);
    }

    // Logout method
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/login');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
