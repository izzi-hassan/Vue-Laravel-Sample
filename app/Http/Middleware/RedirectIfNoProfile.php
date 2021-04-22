<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNoProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if (is_null($user))
            return redirect()->route('login');

        if (is_null($user->profile) || is_null($user->profile->channels)) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
