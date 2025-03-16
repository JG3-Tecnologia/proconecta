<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    // Exibir prompt de verificação de e-mail
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended('/admin')
            : view('auth.verify-email');
    }
}