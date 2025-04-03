<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check()) {
        return redirect()->route('login'); // Use named route
    }

    if (!Auth::user()->is_admin) {
        return redirect()->route('home')->with('error', 'You do not have admin access'); 
    }

    return $next($request);
}
}