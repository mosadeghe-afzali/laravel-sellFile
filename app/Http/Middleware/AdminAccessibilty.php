<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminAccessibilty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if(AuthController::userLevel() == 'admin'){
//                   return $next($request);
//        }
//        else {
//            return redirect('/home');
//        }
        return $next($request);

    }
}
