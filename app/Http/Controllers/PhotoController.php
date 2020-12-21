<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->input('filename');
        $image = $request->file('photo');
        $path = 'public/photos/';
        $extensions = $image->extension();
        $photo = Photo::create([
            'name' => $filename,
            'path' => 'storage/photos/' . $filename . "." . $extensions,
        ]);

        $image->storeAs($path, $filename . "." . $extensions);
        return response()->json($photo, 201);
    }

    public function show($filename)
    {
        $data = Photo::where('name', $filename)->first();
        return response()->json($data, 200);
    }

    public function list()
    {
        $data = Photo::get();
        return response()->json($data, 200);
    }
}
