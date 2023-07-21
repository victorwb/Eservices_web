<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopApiController extends Controller
{
    //
    public function index()
        { 
            $shops = Shop::all();
            foreach($shops as $shop){
                $photoPath =$shop['image'];
                $photoContents = file_get_contents(storage_path('app/' . $photoPath));
                $photoBase64 = base64_encode($photoContents);
                $shop['image']=$photoBase64;
            }
            return response()->json($shops);
        }
        
        public function store(Request $request)
        {
            $shop = Shop::create($request->all());
            return response()->json($shop, 201);
        }
        
        public function update(Request $request, $id)
        {
            $shop = Shop::findOrFail($id);
            $shop->update($request->all());
            return response()->json($shop);
        }
        
        public function destroy($id)
        {
            $shop = Shop::findOrFail($id);
            $shop->delete();
            return response()->json(null, 204);
        }

}
