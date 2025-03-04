<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CustomCanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permission)
    {

        try {
            // super user
            if (Auth::check() && Auth::user()->is_root == ROOT_USER) {
                return $next($request);
            }

            if (!Auth::check() || !Auth::user()->selected_role_data->hasPermissionTo($permission)) {
                abort(403, 'Not Authorized');
            }
        } catch (\Exception $e) {
            abort(403, 'Not Authorized');
        }




        return $next($request);
    }
}
