<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ContainerTrait;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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
            if (!isset($token[1])) {
                throw new TokenBlacklistedException('Token não existente');
            }
            $auth->setToken($token[1]);
            $auth->authenticate();
        } catch(TokenBlacklistedException $ex) {
            return redirect('/');
        } catch(TokenExpiredException $e) {
            return redirect('/');
        }
        return $next($request);
    }
}
