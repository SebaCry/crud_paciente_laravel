<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'documento' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('documento', $request->documento)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()
                ->route('pacientes.index');
        }

        return back()
            ->withErrors(['documento' => 'Las credenciales no coinciden con los datos. '])
            ->withInput($request->only('documento'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('login');
    }
}
