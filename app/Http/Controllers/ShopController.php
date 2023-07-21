<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::get();
        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shops.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:shops',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        Shop::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('Shop added successfully'); 

        return redirect()->route('shop.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shop = Shop::find($id);
        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'rating'=>'required',
            'description'=>'required',
            'location'=>'required'
        ]);

        $shop = Shop::find($id);
        $image=$shop->image;
        // dd($shop);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $shop->name = $request->name;
        $shop->rating=$request->rating;
        $shop ->description=$request->description;
        $shop->image=$image;
        $shop ->location=$request->location;
        $shop->save();
        notify()->success('Shop updated successfully'); 

        return redirect()->route('shop.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shop = Shop::find($id);
        $filename= $shop->image;
        // dd($shop);
        $shop->delete();
        \Storage::delete($filename);
        notify()->success('Shop deleted successfully'); 

        return redirect()->route('shop.index');
    }

}
