<?php

namespace App\Http\Middleware;

use Closure;

class AllowOnlyAdmins
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
        if (! optional($request->user())->is_admin) {
            return redirect('/');
        }

        return $next($request);
    }
}
