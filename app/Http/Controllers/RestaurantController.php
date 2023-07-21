<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:restaurants',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        Restaurant::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('Restaurant added successfully'); 

        return redirect()->route('restaurant.index');

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
        $restaurant = Restaurant::find($id);
        return view('admin.restaurants.edit', compact('restaurant'));
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

        $restaurant = Restaurant::find($id);
        $image=$restaurant->image;
        // dd($restaurant);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $restaurant->name = $request->name;
        $restaurant->rating=$request->rating;
        $restaurant ->description=$request->description;
        $restaurant->image=$image;
        $restaurant ->location=$request->location;
        $restaurant->save();
        notify()->success('Restaurant updated successfully'); 

        return redirect()->route('restaurant.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant = Restaurant::find($id);
        $filename= $restaurant->image;
        // dd($restaurant);
        $restaurant->delete();
        \Storage::delete($filename);
        notify()->success('Restaurant deleted successfully'); 

        return redirect()->route('restaurant.index');
    }

}
