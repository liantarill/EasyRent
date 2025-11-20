<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        return redirect()->route('reset-password.index');


        // dd($request->all());
    }
}
