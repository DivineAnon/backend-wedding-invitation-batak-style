<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        return response()->json(Story::orderBy('order')->orderBy('event_date')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'title_en'    => 'required|string|max:200',
            'event_date'  => 'required|date',
            'description' => 'required|string',
            'description_en' => 'required|string',
            'order'       => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('stories', 'public');
        }

        $story = Story::create($data);

        return response()->json($story, 201);
    }

    public function update(Request $request, Story $story)
    {
        $data = $request->validate([
            'title'          => 'sometimes|string|max:200',
            'title_en'       => 'sometimes|string|max:200',
            'event_date'     => 'sometimes|date',
            'description'    => 'sometimes|string',
            'description_en' => 'sometimes|string',
            'order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($story->image_path) Storage::disk('public')->delete($story->image_path);
            $data['image_path'] = $request->file('image')->store('stories', 'public');
        }

        $story->update($data);

        return response()->json($story);
    }

    public function destroy(Story $story)
    {
        if ($story->image_path) Storage::disk('public')->delete($story->image_path);
        $story->delete();

        return response()->json(['message' => 'Story berhasil dihapus.']);
    }
}
