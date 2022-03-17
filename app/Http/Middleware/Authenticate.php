<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Redirect;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

public function handle($request, Closure $next)
{
    /*if (! $request->expectsJson()) {
        Redirect::route('login')->with('error', 'A valid user account isrequired to see the landing page.');
    }*/
    if (! $request->user() ||
        ($request->user() instanceof MustVerifyEmail &&
        ! $request->user()->hasVerifiedEmail())) {
        return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.') // replace with your message, or path to translation
                : Redirect::route('login')->with('error', 'A valid user account is required to see the landing page.');
    }

    return $next($request);
}
}
