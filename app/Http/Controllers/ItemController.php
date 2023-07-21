<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Hotel;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = request('id');
        $type = request('type');
        $items = Item::where('itemable_id', '=', $id)
                      ->where('itemable_type', '=', $type)
                      ->get();
        
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::get();
        return view('admin.items.add', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'price'=>'required',
            'itemable_type'=>'required',
            'itemable_id'=>'required',
            'no'=>'required',
        ]);

        $image = $request->file('image')->store('public/files');
        Item::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'itemable_type'=>$request->itemable_type,
            'itemable_id'=>$request->itemable_id,
            'no'=>$request->no,
        ]);
        notify()->success('Item added successfully'); 

        return redirect()->route('item.index');

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
        $item = Item::find($id);
        $hotels = Hotel::get();
        return view('admin.items.edit', compact('item','hotels'));
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
            'image'=>'required|mimes:png,jpeg',
            'price'=>'required',
            'type_name'=>'required',
            'type_id'=>'required',
            'no'=>'required',
        ]);

        $item = Item::find($id);
        $image=$item->image;
        // dd($item);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $item->name = $request->name;
        $item->rating=$request->rating;
        $item ->description=$request->description;
        $item->image=$image;
        $item->price=$request->price;
        $item->type_name=$request->type_name;
        $item->type_id=$request->type_id;
        $item->no=$request->no;
        $item->save();
        notify()->success('Item updated successfully'); 

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        $filename= $item->image;
        // dd($item);
        $item->delete();
        \Storage::delete($filename);
        notify()->success('Item deleted successfully'); 

        return redirect()->route('item.index');
    }

}
