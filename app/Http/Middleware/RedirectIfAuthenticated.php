<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect('/home');
            }
            if ($guard == "agents" && Auth::guard($guard)->check()) {
                return redirect('/profile');
            }
            // if (Auth::guard($guard)->check()) {
            //     return redirect('/home');
            // }

            return $next($request);
        
        
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }

        // return $next($request);
        
        
        
    //     if (Auth::guard($guard)->check()) {

    //     if($guard == "admin"){
    //         //user was authenticated with admin guard.
    //         return redirect()->route('home');
    //     } else {
    //         //default guard.
    //         return redirect()->route('home');
    //     }

    // }

    //return $next($request);
    }
    
//     public function handle($request, Closure $next, $guard = null) {   
        
//   switch ($guard) {
//      case 'admin':
//              if (Auth::guard($guard)->check()) {
//              return redirect('/backend');
//           }
//              break;

//      default:
//              if (Auth::guard($guard)->check()) {
//               return redirect('/');
//              }
//              break;
//           }
     
//   return $next($request);
// }
}
