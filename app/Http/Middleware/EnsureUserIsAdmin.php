<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Acesso não autorizado.');
        }

        return $next($request);
    }
}