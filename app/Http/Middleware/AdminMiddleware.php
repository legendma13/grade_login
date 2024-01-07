<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an admin
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        // If not an admin, redirect or handle as needed
        return redirect('/');
    }
}
