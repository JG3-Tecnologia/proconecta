<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmablePasswordController extends Controller
{
    // Exibir formulário de confirmação de senha
    public function show()
    {
        return view('auth.confirm-password');
    }

    // Processar confirmação de senha
    public function store(Request $request)
    {
        if (!Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/admin');
    }
}