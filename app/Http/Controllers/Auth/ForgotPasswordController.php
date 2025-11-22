<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.email');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        Auth::login($user);
        $type = 'reset_password';
        // return redirect()->route('verify.index', $type);
        return redirect()->route('reset-password.index');


        // dd($request->all());
    }
}
