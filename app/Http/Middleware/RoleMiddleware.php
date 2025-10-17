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
            return redirect()->route('login');
        }
        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            Log::warning('Unauthorized role access attempt.', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
                'allowed_roles' => $roles,
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
            ]);
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
