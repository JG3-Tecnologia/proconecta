<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Exibir formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processar login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}