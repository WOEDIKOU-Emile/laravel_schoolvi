<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'    => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nom'        => $request->nom,
            'prenom'     => $request->prenom,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $user->isAdmin()
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email'      => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        \Illuminate\Support\Facades\Auth::login($user);
        $request->session()->regenerate();

        return $user->isAdmin()
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect.',
    ])->onlyInput('email');
}

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
