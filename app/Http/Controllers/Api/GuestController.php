<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    // Public: get guest by slug
    public function findBySlug(string $slug)
    {
        $guest = Guest::where('slug', $slug)->first();

        if (!$guest) {
            return response()->json(['message' => 'Tamu tidak ditemukan.'], 404);
        }

        // Mark as opened
        if (!$guest->has_opened) {
            $guest->update(['has_opened' => true, 'opened_at' => now()]);
        }

        return response()->json($guest);
    }

    // Admin: list all guests
    public function index(Request $request)
    {
        $query = Guest::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }
        if ($request->rsvp_status) {
            $query->where('rsvp_status', $request->rsvp_status);
        }
        if ($request->has('attended_church')) {
            $query->where('attended_church', filter_var($request->attended_church, FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->has('attended_reception')) {
            $query->where('attended_reception', filter_var($request->attended_reception, FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->has('has_opened')) {
            $query->where('has_opened', filter_var($request->has_opened, FILTER_VALIDATE_BOOLEAN));
        }

        $guests = $query->orderBy('name')->paginate(100); // Increased pagination limit to make filtering easier

        return response()->json($guests);
    }

    // Admin: create guest
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'nullable|string|max:20',
            'email'    => 'nullable|email',
            'language' => 'in:id,en',
            'category' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name'] . '-' . Str::random(6));

        $guest = Guest::create($data);

        \App\Jobs\SendGuestInvitation::dispatch($guest);

        return response()->json($guest, 201);
    }

    // Admin: update guest
    public function update(Request $request, Guest $guest)
    {
        $data = $request->validate([
            'name'             => 'sometimes|string|max:100',
            'phone'            => 'nullable|string|max:20',
            'email'            => 'nullable|email',
            'language'         => 'in:id,en',
            'category'         => 'nullable|string',
            'rsvp_status'      => 'in:pending,hadir,tidak_hadir',
            'attendance_count' => 'integer|min:1',
        ]);

        $guest->update($data);

        return response()->json($guest);
    }

    // Admin: delete guest
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Tamu berhasil dihapus.']);
    }

    // Admin: import guests from CSV data
    public function import(Request $request)
    {
        $request->validate(['guests' => 'required|array']);

        $created = 0;
        foreach ($request->guests as $row) {
            if (empty($row['name'])) continue;
            $guest = Guest::create([
                'name'     => $row['name'],
                'phone'    => $row['phone'] ?? null,
                'email'    => $row['email'] ?? null,
                'language' => $row['language'] ?? 'id',
                'category' => $row['category'] ?? null,
                'slug'     => Str::slug($row['name'] . '-' . Str::random(6)),
            ]);
            
            \App\Jobs\SendGuestInvitation::dispatch($guest);
            $created++;
        }

        return response()->json(['message' => "$created tamu berhasil diimport dan undangan sedang dikirim."]);
    }

    // Admin: get QR link for guest
    public function qrLink(Guest $guest)
    {
        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');
        $link = "$frontendUrl/invite/{$guest->slug}";

        return response()->json([
            'guest' => $guest->name,
            'slug'  => $guest->slug,
            'link'  => $link,
        ]);
    }

    public function resendNotification(Guest $guest)
    {
        $guest->email_status = 'pending';
        $guest->wa_status = 'pending';
        $guest->save();

        \App\Jobs\SendGuestInvitation::dispatch($guest);

        return response()->json(['message' => 'Notification resend triggered.']);
    }
}
