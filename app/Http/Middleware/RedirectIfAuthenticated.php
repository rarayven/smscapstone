<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $type = Auth::user()->type;
            if($type == 'Admin')
                return redirect('admin/dashboard');
            elseif($type == 'Coordinator')
                return redirect('coordinator/dashboard');
            elseif($type == 'Student')
                return redirect('student/dashboard');
            // return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
