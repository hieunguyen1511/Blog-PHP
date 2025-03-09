<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('userid') != null) {
            $user = User::find(session('userid')); 
            if ($user -> role != User::$role_admin) {
                return redirect()->route('home');
            }
            //session()->forget('previous_url');
        }
        return $next($request);
    }
}