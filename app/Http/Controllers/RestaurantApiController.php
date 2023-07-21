<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantApiController extends Controller
{
    //
        //
        public function index()
        {
            $restaurants = Restaurant::all();
            foreach($restaurants as $shop){
                $photoPath =$shop['image'];
                $photoContents = file_get_contents(storage_path('app/' . $photoPath));
                $photoBase64 = base64_encode($photoContents);
                $shop['image']=$photoBase64;
            }
            return response()->json($restaurants);
        }
        
        public function store(Request $request)
        {
            $user = Restaurant::create($request->all());
            return response()->json($user, 201);
        }
        
        public function update(Request $request, $id)
        {
            $user = Restaurant::findOrFail($id);
            $user->update($request->all());
            return response()->json($user);
        }
        
        public function destroy($id)
        {
            $user = Restaurant::findOrFail($id);
            $user->delete();
            return response()->json(null, 204);
        }
}
