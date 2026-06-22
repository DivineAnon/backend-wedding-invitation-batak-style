<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhotoBooth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoBoothController extends Controller
{
    // Public: upload photo
    public function store(Request $request)
    {
        $request->validate([
            'image'      => 'required|image|max:5120',
            'guest_name' => 'nullable|string|max:100',
            'caption'    => 'nullable|string|max:200',
            'guest_id'   => 'nullable|exists:guests,id',
        ]);

        $path = $request->file('image')->store('photobooth', 'public');

        $photo = PhotoBooth::create([
            'guest_id'   => $request->guest_id,
            'guest_name' => $request->guest_name,
            'image_path' => $path,
            'caption'    => $request->caption,
            'is_approved' => true,
        ]);

        return response()->json($photo, 201);
    }

    // Public: list approved photos
    public function index()
    {
        $photos = PhotoBooth::where('is_approved', true)
            ->orderByDesc('created_at')
            ->get();

        return response()->json($photos);
    }

    // Admin: list all photos with moderation
    public function adminIndex()
    {
        $photos = PhotoBooth::with('guest')->orderByDesc('created_at')->paginate(20);
        return response()->json($photos);
    }

    // Admin: approve/reject photo
    public function toggleApproval(PhotoBooth $photoBooth)
    {
        $photoBooth->update(['is_approved' => !$photoBooth->is_approved]);
        return response()->json($photoBooth);
    }

    // Admin: delete photo
    public function destroy(PhotoBooth $photoBooth)
    {
        Storage::disk('public')->delete($photoBooth->image_path);
        $photoBooth->delete();

        return response()->json(['message' => 'Foto berhasil dihapus.']);
    }
}
