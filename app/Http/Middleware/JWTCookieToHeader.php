<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JWTCookieToHeader
{
    /**
     * Copia o cookie “jwt_token” para o header Authorization: Bearer …
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->cookies->has('jwt_token') && ! $request->headers->has('Authorization')) {
            $token = $request->cookie('jwt_token');
            $request->headers->set('Authorization', 'Bearer '.$token);
        }

        return $next($request);
    }
}
