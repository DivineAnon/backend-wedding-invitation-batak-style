<?php

namespace App\Http\Middleware;

use App\Models\AdminToken;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $adminToken = AdminToken::with('admin')->where('token', $token)->first();

        if (!$adminToken || $adminToken->isExpired()) {
            return response()->json(['message' => 'Token invalid or expired.'], 401);
        }

        // Attach admin to request
        $request->merge(['_admin' => $adminToken->admin]);

        return $next($request);
    }
}
