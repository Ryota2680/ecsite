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
//     public function handle($request, Closure $next, $guard = null) 
//     {
//         // dump($guard);
//         if (Auth::guard($guard)->check()) {
//             // return redirect('/home');
//             //ログイン後に飛ぶ
//             return redirect('admin/home');
//         }

//         return $next($request);
//     }
// }
    public function handle($request, Closure $next, $guard = null) {
        //ユーザー側のログイン後のリダイレクト先
		$redirectTo = '/';

		if ($guard === 'admin') {
            //アドミン側のログイン後のリダイレクト先
			$redirectTo = '/admin/home';
			// $redirectTo = '/admin/login';
		}
		if (Auth::guard($guard)->check()) {
			return redirect($redirectTo);
		}
		return $next($request);
	}
}
