<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class EmailVerificationNotificationController extends Controller
{
    // Enviar notificação de verificação de e-mail
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/admin');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Link de verificação enviado.');
    }
}