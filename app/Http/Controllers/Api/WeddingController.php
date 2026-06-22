<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingController extends Controller
{
    public function show()
    {
        $wedding = Wedding::where('is_active', true)->first();

        if (!$wedding) {
            return response()->json(['message' => 'Wedding not configured.'], 404);
        }

        return response()->json($wedding);
    }

    public function update(Request $request)
    {
        $wedding = Wedding::firstOrCreate(['is_active' => true]);

        $data = $request->validate([
            'couple_name_1'  => 'sometimes|string|max:100',
            'couple_name_2'  => 'sometimes|string|max:100',
            'marga_1'        => 'nullable|string|max:100',
            'marga_2'        => 'nullable|string|max:100',
            'bio_1'          => 'nullable|string',
            'bio_2'          => 'nullable|string',
            'akad_date'      => 'sometimes|date',
            'akad_time'      => 'sometimes|string',
            'akad_venue'     => 'sometimes|string',
            'akad_address'   => 'sometimes|string',
            'akad_maps_url'  => 'nullable|string',
            'resepsi_date'   => 'sometimes|date',
            'resepsi_time'   => 'sometimes|string',
            'resepsi_venue'  => 'sometimes|string',
            'resepsi_address' => 'sometimes|string',
            'maps_url'       => 'nullable|string',
            'love_story'     => 'nullable|string',
            'music_url'      => 'nullable|string',
            'music_title'    => 'nullable|string',
        ]);

        // Handle image uploads
        foreach (['photo_1', 'photo_2', 'cover_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($wedding->$field) {
                    Storage::disk('public')->delete($wedding->$field);
                }
                $data[$field] = $request->file($field)->store('wedding', 'public');
            }
        }

        $wedding->update($data);

        return response()->json($wedding);
    }
}
