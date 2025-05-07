<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;

class EnsureApiAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()) {
            throw new AuthenticationException('Não autenticado.');
        }

        return $next($request);
    }
}