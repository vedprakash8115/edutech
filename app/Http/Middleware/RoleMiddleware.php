<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('inslogin'); // Redirect to login if not authenticated
        }

        $user = Auth::user();
        // Check if the user has the required role
        if (!$user->hasRole($role)) {
            // If user doesn't have the role, you can redirect them
            if ($user->hasRole('student')) {
                return redirect()->route('student.profile')->with('error', 'Access denied!');
            } else {
                return redirect()->route('insdashboard')->with('error', 'Access denied!');
            }
        }

        return $next($request); // Proceed if role matches
    }
}
