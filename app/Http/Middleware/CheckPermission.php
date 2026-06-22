<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $page    Slug halaman (e.g. 'berita', 'pengumuman')
     * @param  string  $action  Aksi yang diperlukan (e.g. 'view', 'create', 'edit', 'delete')
     */
    public function handle(Request $request, Closure $next, string $page, string $action): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // Superadmin bypass semua permission
        if ($admin->is_superadmin) {
            return $next($request);
        }

        // Load roles jika belum loaded
        if (!$admin->relationLoaded('roles')) {
            $admin->load('roles');
        }

        if (!$admin->hasPermission($page, $action)) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        return $next($request);
    }
}
