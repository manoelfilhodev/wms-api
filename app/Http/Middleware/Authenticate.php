<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Retorna 401 em vez de tentar redirecionar
        if (!$request->expectsJson()) {
            abort(401, 'Não autenticado.');
        }

        return null;
    }
}
