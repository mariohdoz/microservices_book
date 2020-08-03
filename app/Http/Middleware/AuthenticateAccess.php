<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class AuthenticateAccess
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
        $validSecrets = explode(',', env('VALID_SECRETS'));

        // Se valida si secreto viene adjunto
        if(in_array($request->header('Authorization'), $validSecrets)){
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);

    }
}
