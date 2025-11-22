<?php

namespace App\Http\Middleware;

use App\Models\EmailVerification;
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
    public function handle(Request $request, Closure $next, $type = "login"): Response
    {
        $user = $request->user();


        if (! $user) {
            return redirect()->route('login');
        }
        $uniqueId = session('verification_unique_id');

        $hasValidVerification = EmailVerification::where('user_id', $user->id)
            ->where('status', 'valid')
            ->where('unique_id', $uniqueId)
            ->exists();

        // dd($hasValidVerification);

        if ($hasValidVerification) {
            return $next($request);
        }

        if ($type === 'reset_password') {
            return redirect()->route('verify.index', $type);
            // if ($user->status === 'verify') {
            // }
        } else {
            if ($user->status === 'active') {
                return $next($request);
            }
        }


        // Status lain → optional, misal "banned"
        return abort(403, 'Your account status does not allow access.');
    }
}
