<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RememberMeHandler
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
        //ブラウザを閉じてもログイン維持
        if(Auth::viaRemember()){    // Remember Meでの認証時
            Log::notice('Remember Me Logged in');
            // 行いたい処理を書く
        }
        return $next($request);
    }
}
