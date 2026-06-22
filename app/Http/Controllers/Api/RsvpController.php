<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug'             => 'required|string',
            'rsvp_status'      => 'required|in:hadir,tidak_hadir',
            'attendance_count' => 'nullable|integer|min:1|max:10',
            'message'          => 'nullable|string|max:500',
        ]);

        $guest = Guest::where('slug', $data['slug'])->first();

        if (!$guest) {
            return response()->json(['message' => 'Tamu tidak ditemukan.'], 404);
        }

        $guest->update([
            'rsvp_status'      => $data['rsvp_status'],
            'attendance_count' => $data['attendance_count'] ?? 1,
            'message'          => $data['message'] ?? null,
        ]);

        return response()->json([
            'message' => $data['rsvp_status'] === 'hadir'
                ? 'Terima kasih! Kami menantikan kehadiran Anda.'
                : 'Terima kasih atas konfirmasinya.',
            'guest'   => $guest,
        ]);
    }
}
