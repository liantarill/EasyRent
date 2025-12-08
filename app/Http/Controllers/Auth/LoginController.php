<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // user yang login

            if ($user->status === 'active') {
                return redirect()->intended('dashboard')
                    ->with('success', 'Selamat datang, ' . $user->username . '!');
            }

            // Jika user belum active → logout dan simpan session untuk OTP
            session(['user_id' => $user->id]);

            Auth::logout(); // logout benar-benar

            return redirect()->route('verify.index', ['register'])
                ->with('success', 'Selamat datang, ' . $user->username . '!');
        }
        return back()->withInput($request->only('email'))->with('failed', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
