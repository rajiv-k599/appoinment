<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, $role): Response
    {
         // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('/login');
        }
        // Get the authenticated user's role
        $userRole = auth()->user()->type; // Assuming 'role' is the column in your users table representing the user's role
        // Check if the user has the required role
       
        if ($userRole != $role) {
            // User does not have the required role, redirect or return an error response
            abort(403, 'Unauthorized action.');
        }
        // User has the required role, proceed with the request
        return $next($request);
    }
}
