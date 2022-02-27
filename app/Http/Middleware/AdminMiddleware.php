<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        //管理者ユーザーしか見れない
        $user = Auth::user();
        foreach($user->roles as $role){
            if($role->name=='admin'){
                return $next($request);
            }else{
                abort(404);
            }
        }
    }
}
