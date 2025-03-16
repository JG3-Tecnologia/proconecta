<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    // Verificar e-mail
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/admin');
        }

        $request->user()->markEmailAsVerified();

        return redirect()->intended('/admin')->with('status', 'E-mail verificado com sucesso.');
    }
}