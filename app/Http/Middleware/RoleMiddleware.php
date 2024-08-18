<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        Log::info('User Role:', ['role' => $user->role]);

        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized action.');
            //Log::error('User does not have the required role', ['required_roles' => $roles, 'user_role' => $user->role]);
            //return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
