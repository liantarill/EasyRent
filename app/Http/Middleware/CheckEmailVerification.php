<?php

namespace App\Http\Middleware;

use App\Models\EmailVerification;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {

        //kalo forgot password dia tidak login.
        //dari forgot password mengirim session isinya id user yang emailnya diinputkan
        $userId = session('user_id');
        $user = $userId ? User::find($userId) : $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // input otp mengirimkan session uniqe otp
        // dicek apa ada, kalo ada ke page selanjutnya
        $uniqueId = session('verification_unique_id');

        $hasValidVerification = EmailVerification::where('user_id', $user->id)
            ->where('status', 'valid')
            ->where('unique_id', $uniqueId)
            ->exists();
        if ($hasValidVerification) {
            return $next($request);
        }

        // Jika user yang bisa langsung login yang statusnya active
        if ($user->status === 'active' && $type === 'login') {
            return $next($request);
        }


        // type dikirim dari route, sesuai page yang dituju.
        // jika yang dituju Reset Password maka type = reset_password
        if ($type === 'reset_password') {
            return redirect()->route('verify.index', $type);
        }


        // Jika status user masi verify harus send otp
        if ($user->status === 'verify') {
            return redirect()->route('verify.index', $type);
        }


        // Status lain → optional, misal "banned"
        return abort(403, 'Your account status does not allow access.');
    }
}
