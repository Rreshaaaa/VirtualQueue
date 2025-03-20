<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid student credentials.']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/student/login');
    }
}
