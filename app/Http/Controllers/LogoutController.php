<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    // Student Logout
    public function logoutStudent(Request $request)
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }
    }

    // Admin Logout
    public function logoutAdmin(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }
    }
}
