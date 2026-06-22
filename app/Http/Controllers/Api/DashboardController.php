<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Gallery;
use App\Models\PhotoBooth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuests = Guest::count();
        $hadir = Guest::where('rsvp_status', 'hadir')->count();
        $tidakHadir = Guest::where('rsvp_status', 'tidak_hadir')->count();
        $pending = Guest::where('rsvp_status', 'pending')->count();
        $totalAttendance = Guest::where('rsvp_status', 'hadir')->sum('attendance_count');
        $opened = Guest::where('has_opened', true)->count();
        $attendedChurch = Guest::where('attended_church', true)->count();
        $attendedReception = Guest::where('attended_reception', true)->count();
        $totalPhotos = PhotoBooth::count();
        $pendingPhotos = PhotoBooth::where('is_approved', false)->count();
        $totalGallery = Gallery::where('type', 'couple')->count();

        $recentRsvp = Guest::whereIn('rsvp_status', ['hadir', 'tidak_hadir'])
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get(['name', 'rsvp_status', 'attendance_count', 'message', 'updated_at']);

        return response()->json([
            'stats' => [
                'total_guests'     => $totalGuests,
                'hadir'            => $hadir,
                'tidak_hadir'      => $tidakHadir,
                'pending'          => $pending,
                'total_attendance' => $totalAttendance,
                'opened'           => $opened,
                'attended_church'  => $attendedChurch,
                'attended_reception' => $attendedReception,
                'total_photos'     => $totalPhotos,
                'pending_photos'   => $pendingPhotos,
                'total_gallery'    => $totalGallery,
            ],
            'recent_rsvp' => $recentRsvp,
        ]);
    }
}
