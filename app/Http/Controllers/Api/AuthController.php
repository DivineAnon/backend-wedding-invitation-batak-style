<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Email atau password salah.'], 401);
        }

        // Revoke old tokens
        AdminToken::where('admin_id', $admin->id)->delete();

        $token = AdminToken::create([
            'admin_id'   => $admin->id,
            'token'      => Str::random(64),
            'expires_at' => now()->addDays(7),
        ]);

        return response()->json([
            'token' => $token->token,
            'admin' => [
                'id'    => $admin->id,
                'name'  => $admin->name,
                'email' => $admin->email,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        AdminToken::where('token', $token)->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }

    public function me(Request $request)
    {
        $admin = $request->get('_admin');
        return response()->json(['admin' => $admin]);
    }
}
