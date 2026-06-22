<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    /**
     * Scan a guest's QR code.
     * Expects: slug, event_type ('church' or 'reception')
     */
    public function scan(Request $request)
    {
        $request->validate([
            'slug' => 'required|string',
            'event_type' => 'required|in:church,reception',
        ]);

        $guest = Guest::where('slug', $request->slug)->first();

        if (!$guest) {
            return response()->json(['message' => 'Tamu tidak ditemukan.'], 404);
        }

        $eventType = $request->event_type;

        if ($eventType === 'church') {
            if ($guest->attended_church) {
                return response()->json([
                    'message' => "Tamu {$guest->name} sudah di-scan untuk acara Gereja pada " . $guest->church_scanned_at->format('H:i'),
                    'guest' => $guest,
                    'already_scanned' => true
                ], 200);
            }

            $guest->attended_church = true;
            $guest->church_scanned_at = now();
            $guest->save();

            return response()->json([
                'message' => "Berhasil scan! Selamat datang di Gereja, {$guest->name}.",
                'guest' => $guest,
                'already_scanned' => false
            ], 200);

        } else {
            // Reception
            if ($guest->attended_reception) {
                return response()->json([
                    'message' => "Tamu {$guest->name} sudah di-scan untuk acara Gedung pada " . $guest->reception_scanned_at->format('H:i'),
                    'guest' => $guest,
                    'already_scanned' => true
                ], 200);
            }

            $guest->attended_reception = true;
            $guest->reception_scanned_at = now();
            $guest->save();

            return response()->json([
                'message' => "Berhasil scan! Selamat menikmati acara resepsi, {$guest->name}.",
                'guest' => $guest,
                'already_scanned' => false
            ], 200);
        }
    }
}
