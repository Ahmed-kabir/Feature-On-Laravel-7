<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Login
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
        
       // $user = Session::get('userData')['fname'];
        if (!$request->session()->exists('userData'))
        // if($user != '')
        {
            
            return redirect('/login');
            
        }
       
        return $next($request);

    }
    
}
