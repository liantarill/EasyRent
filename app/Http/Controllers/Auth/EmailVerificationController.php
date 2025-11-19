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
        return view('verification.index');
    }

    public function show($unique_id)
    {
        $verify = EmailVerification::where('user_id', Auth::id())
            ->where('unique_id', $unique_id)
            ->first();

        if (!$verify) {
            abort(404);
        }
        return view('verification.show', compact('unique_id'));
    }


    public function update(Request $request, $unique_id)
    {
        // dd($request->all());
        $verify = EmailVerification::where('user_id', Auth::id())
            ->where('unique_id', $unique_id)
            ->first();
        if (!$verify) abort(404);

        // Check if already used or expired
        // if ($verify->status != 'active') {
        //     return back()->withErrors(['otp' => 'OTP already used or expired']);
        // }

        // Check OTP
        if (!Hash::check($request->otp, $verify->otp)) {
            $verify->update(['status' => 'invalid']);
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Correct OTP
        $verify->update(['status' => 'valid']);
        $verify->user->update(['status' => 'active']);

        return redirect()->intended('profile-completion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:register,reset',
        ]);

        if ($request->type === 'register') {
            $user = $request->user();
        } else {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            return back()->with('failed', 'User not found.');
        }

        $otp = rand(100000, 999999);
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
        }
    }
}
