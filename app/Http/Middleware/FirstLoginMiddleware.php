<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class FirstLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guest()){
            if(Auth::user()->type == 'Coordinator'){
                if(Auth::user()->last_login == null){
                    return $next($request);
                }
                return redirect('coordinator/dashboard');
            }
        }
        return redirect('login');
    }
}
