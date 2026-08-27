<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Auth::user() is a helper function that returns the currently authenticated user harusnya 
        // auth()->user() is the correct way to get the authenticated user in Laravel. The code checks 
        // if the authenticated user's role is not 'admin'. If the user is not an admin, it redirects 
        // them to the 'home' route. If the user is an admin, it allows the request to proceed to the next middleware or controller.
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home');
        }
            
        return $next($request);
    }
}
