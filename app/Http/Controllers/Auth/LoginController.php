<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $empresa = Empresa::findOrFail($request->query('empresa_id'));
        return view('auth.login', compact('empresa'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    $credentials['empresa_id'] = $request->empresa_id;

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        // Redirige a la lista de pedidos
        return redirect()->route('pedidos.index');
    }

    return back()
        ->withInput($request->only('email','remember'))
        ->withErrors(['email' => 'Las credenciales no coinciden.']);
    }
}
