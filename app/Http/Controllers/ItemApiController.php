<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemApiController extends Controller
{
    //
    public function index()
{ 
    $items = Item::all();
    foreach($items as $item){
        $photoPath =$item['image'];
        $photoContents = file_get_contents(storage_path('app/' . $photoPath));
        $photoBase64 = base64_encode($photoContents);
        $item['image']=$photoBase64;
    }
    return response()->json($items);
}

public function itemParent()
{ 
    $id = request('id'); 
    $type = request('type'); 
        // $type = 'Hotel';
        $items = Item::where('itemable_id', '=', $id)
                      ->where('itemable_type', '=', $type)
                      ->get();
    foreach($items as $item){
        $photoPath =$item['image'];
        $photoContents = file_get_contents(storage_path('app/' . $photoPath));
        $photoBase64 = base64_encode($photoContents);
        $item['image']=$photoBase64;
    }
    return response()->json($items);
}



public function store(Request $request)
{
    $user = Item::create($request->all());
    return response()->json($user, 201);
}

public function update(Request $request, $id)
{
    $user = Item::findOrFail($id);
    $user->update($request->all());
    return response()->json($user);
}

public function destroy($id)
{
    $user = Item::findOrFail($id);
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
