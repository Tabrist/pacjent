<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class BearerToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $token = $request->bearerToken();
        $user = User::userByToken($token);
        if ($user === null || $token === null) {
            return response([
                'msg' => 'Token is not correct'
                    ], 422);
        } else {
            return $next($request);
        }
    }

}
