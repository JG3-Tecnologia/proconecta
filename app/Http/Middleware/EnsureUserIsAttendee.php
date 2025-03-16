<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAttendee
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role !== 'atendente') {
            return redirect('/')->with('error', 'Acesso não autorizado.');
        }

        return $next($request);
    }
}