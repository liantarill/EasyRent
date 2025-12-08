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
    public function index($type)
    {
        return view('verification.index', compact('type'));
    }

    public function show($type, $unique_id)
    {

        // dd(session()->all());
        $verify = EmailVerification::where('unique_id', $unique_id)->first();


        if (!$verify) {
            abort(404);
        }
        return view('verification.show', compact('type', 'unique_id'));
    }


    public function update(Request $request, $type, $unique_id)
    {

        $verify = EmailVerification::where('unique_id', $unique_id)->first();

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

        session(['verification_unique_id' => $unique_id]);
        if ($type === 'reset_password') {
            return redirect()->route('reset-password.index');
        } else if ($type === 'register') {
            Auth::login($verify->user);
            return redirect()->route('profile-completion');
        } else if ($type === 'login') {
            Auth::login($verify->user);
            return redirect()->route('customer.dashboard');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'type' => 'required|in:register,reset_password',
            'type' => 'required|in:register,reset_password,login',
        ]);


        $userId = session('user_id');
        $user = $userId ? User::find($userId) : $request->user();

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
        return redirect()->route('verify.show', [$request->type, $verify->unique_id]);
    }
}
