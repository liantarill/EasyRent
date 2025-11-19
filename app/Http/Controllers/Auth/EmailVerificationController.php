<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpEmail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function index()
    {
        return view('auth.email-verification');
    }

    public function show($unique_id)
    {
        $verify = EmailVerification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)->whereStatus('active')->count();
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:register,reset',
        ]);

        // If verification is for register
        if ($request->type === 'register') {
            $user = $request->user();
        } else {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            return back()->with('failed', 'User not found.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Create verification record
        $verify = EmailVerification::create([
            'user_id'   => $user->id,
            'unique_id' => Str::uuid(),
            'otp'       => Hash::make($otp),
            'type'      => $request->type,
            'send_via'  => 'email',
            'status'    => 'active',
        ]);

        Mail::to($user->email)->queue(new OtpEmail($otp));
        if ($request->type === 'register') {
            return redirect('/verify/' . $verify->unique_id);
            // return back()->with('success', 'OTP sent to your email.');
        }
    }
}
