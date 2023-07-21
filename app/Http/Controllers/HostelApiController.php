<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;

class HostelApiController extends Controller
{
    //
    public function index()
{
    $hostels = Hostel::all();
    foreach($hostels as $hostel){
        $photoPath =$hostel['image'];
        $photoContents = file_get_contents(storage_path('app/' . $photoPath));
        $photoBase64 = base64_encode($photoContents);
        $hostel['image']=$photoBase64;
    }
    return response()->json($hostels);
}

public function store(Request $request)
{
    $user = Hostel::create($request->all());
    return response()->json($user, 201);
}

public function update(Request $request, $id)
{
    $user = Hostel::findOrFail($id);
    $user->update($request->all());
    return response()->json($user);
}

public function destroy($id)
{
    $user = Hostel::findOrFail($id);
    $user->delete();
    return response()->json(null, 204);
}

public function show($filename)
{
    $path = storage_path('public/files/' . $filename);

        if (!\Storage::exists($path)) {
            return response()->json(['error' => 'Image not found.'], 404);
        }

        $file = \Storage::get($path);
        $type = \Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
}
}
