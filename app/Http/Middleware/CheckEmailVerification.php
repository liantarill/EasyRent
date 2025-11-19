<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->status === 'active') {
            return $next($request);
        } else if ($user->status === 'verify') {
            return redirect()->route('verify.index');
        }


        // Status lain → optional, misal "banned"
        return abort(403, 'Your account status does not allow access.');
    }
}
