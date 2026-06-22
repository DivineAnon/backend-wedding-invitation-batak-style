<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandlePjaxRequest
{
    /**
     * Handle an incoming request - detect PJAX and modify view rendering
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-PJAX')) {
            $request->attributes->set('pjax', true);
        }

        return $next($request);
    }
}
