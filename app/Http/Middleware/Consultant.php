<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Consultant
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role == 0) {
            return redirect()->route('home');
        }
        // if (Auth::user()->role == 2 && Auth::user()->consultant_id !=null) {
        if (Auth::user()->role == 2 || Auth::user()->role == 3) {

            // return redirect()->route('user.dashboard');
            return $next($request);
        }
        else{
            return redirect()->route('party')->with('error','Please Select A Sponsor');
        }
    }
}
