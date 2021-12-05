<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;

class JwtAuthenticate
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
        $token = JWTAuth::parseToken()->check();

        if ($token == true) {
            return $next($request);
        } else {
            $error = ["status" => 401, "erro" => "Token inválido."];
            return response()->json($error, 401);
        }

    }
}
