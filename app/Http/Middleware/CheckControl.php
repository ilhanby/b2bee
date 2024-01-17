<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckControl
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::user()->status != 1) {

            Log::channel('db')->info('User not allowed', [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]);

            Auth::logout();
            Session::flush();

            return redirect(route('login'))->with('error', __('admin.messages.not_allowed'));
        } else {
            return $next($request);
        }
    }
}
