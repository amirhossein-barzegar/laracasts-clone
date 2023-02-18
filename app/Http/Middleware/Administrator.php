<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // create a custom configuration file
        if(auth()->check()) {
            if(auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                session()->flash('error', 'You are not authorized to perform this action');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
