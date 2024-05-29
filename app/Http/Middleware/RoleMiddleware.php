<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next): Response
    {
            if (!Auth::check()) {
                return redirect('login');
            }
    
            $user = Auth::user();
            if (!in_array($user->role, $roles)) {
                return redirect('home')->with('error', 'You do not have access to this section.');
            }
    
            return $next($request);
        
    }
}