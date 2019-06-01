<?php

namespace Evention\Http\Middleware;

use Closure;
use Evention\Services\Facades\TemporaryUser as TemporaryUserService;

class TemporaryUser
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
        if (! auth()->guest()) {
            return $next($request);
        }

        $cookie = config('evention.temporary_user.cookie');

        if ($request->hasCookie($cookie)) {
            if (TemporaryUserService::hasToken()) {
                return $next($request);
            }
        }

        $token = TemporaryUserService::generateToken();

        \Cookie::queue(\Cookie::forever(config('evention.temporary_user.cookie'), $token));

        TemporaryUserService::create($token);

        return $next($request);
    }
}
