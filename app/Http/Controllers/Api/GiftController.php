<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    public function index()
    {
        return response()->json(Gift::where('is_active', true)->orderBy('order')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name'      => 'required|string|max:100',
            'account_number' => 'required|string|max:30',
            'account_name'   => 'required|string|max:100',
            'order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('qr_image')) {
            $data['qr_image'] = $request->file('qr_image')->store('gifts', 'public');
        }

        $gift = Gift::create($data);

        return response()->json($gift, 201);
    }

    public function update(Request $request, Gift $gift)
    {
        $data = $request->validate([
            'bank_name'      => 'sometimes|string|max:100',
            'account_number' => 'sometimes|string|max:30',
            'account_name'   => 'sometimes|string|max:100',
            'order'          => 'nullable|integer',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('qr_image')) {
            if ($gift->qr_image) Storage::disk('public')->delete($gift->qr_image);
            $data['qr_image'] = $request->file('qr_image')->store('gifts', 'public');
        }

        $gift->update($data);

        return response()->json($gift);
    }

    public function destroy(Gift $gift)
    {
        if ($gift->qr_image) Storage::disk('public')->delete($gift->qr_image);
        $gift->delete();

        return response()->json(['message' => 'Rekening berhasil dihapus.']);
    }
}
