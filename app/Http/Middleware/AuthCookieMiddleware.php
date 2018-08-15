<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ContainerTrait;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AuthCookieMiddleware
{

    use ContainerTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->route()->uri() == '/') {
            return $next($request);
        }
        $token = explode(' ', $request->cookie('Authorization'));
        $auth = $this->container->make(JWTAuth::class);
        if (count($token) < 1) {
            return redirect('/');
        }
        try {
            $auth->setToken($token[1]);
            $auth->authenticate();
        } catch(TokenBlacklistedException $ex) {
            return redirect('/');
        }
        return $next($request);
    }
}
