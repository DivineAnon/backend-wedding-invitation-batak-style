<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type ?? null;

        $query = Gallery::where('is_visible', true)->orderBy('order');

        if ($type) {
            $query->where('type', $type);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|max:5120',
            'caption' => 'nullable|string|max:200',
            'type'    => 'in:couple,photobooth',
            'order'   => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        $gallery = Gallery::create([
            'image_path' => $path,
            'caption'    => $request->caption,
            'type'       => $request->type ?? 'couple',
            'order'      => $request->order ?? 0,
        ]);

        return response()->json($gallery, 201);
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return response()->json(['message' => 'Foto berhasil dihapus.']);
    }
}
