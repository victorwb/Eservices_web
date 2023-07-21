<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labour;

class LabourApiController extends Controller
{
    //
    public function index()
{
    $hostels = Labour::all();
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
    $labour = Labour::create($request->all());
    return response()->json($labour, 201);
}

public function update(Request $request, $id)
{
    $labour = Labour::findOrFail($id);
    $labour->update($request->all());
    return response()->json($labour);
}

public function destroy($id)
{
    $labour = Labour::findOrFail($id);
    $labour->delete();
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
