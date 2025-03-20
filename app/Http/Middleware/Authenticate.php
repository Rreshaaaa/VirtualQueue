<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // If the user is authenticated but trying to access the wrong dashboard, show 403
            if ($request->is('admin/*') && auth('student')->check()) {
                abort(403, 'Unauthorized action.');
            }

            if ($request->is('student/*') && auth('admin')->check()) {
                abort(403, 'Unauthorized action.');
            }

            // If the user is not authenticated, redirect to the appropriate login
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            if ($request->is('student/*')) {
                return route('student.login');
            }

            abort(403, 'Unauthorized action.');
        }
    }
}
