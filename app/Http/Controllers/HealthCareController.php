<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthCare;

class HealthCareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthcares = HealthCare::get();
        return view('admin.healthcares.index', compact('healthcares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.healthcares.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:health_cares',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        HealthCare::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('HealthCare added successfully'); 

        return redirect()->route('healthcare.index');

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
        $healthcare = HealthCare::find($id);
        return view('admin.healthcares.edit', compact('healthcare'));
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

        $healthcare = HealthCare::find($id);
        $image=$healthcare->image;
        // dd($healthcare);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $healthcare->name = $request->name;
        $healthcare->rating=$request->rating;
        $healthcare ->description=$request->description;
        $healthcare->image=$image;
        $healthcare ->location=$request->location;
        $healthcare->save();
        notify()->success('HealthCare updated successfully'); 

        return redirect()->route('healthcare.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $healthcare = HealthCare::find($id);
        $filename= $healthcare->image;
        // dd($healthcare);
        $healthcare->delete();
        \Storage::delete($filename);
        notify()->success('HealthCare deleted successfully'); 

        return redirect()->route('healthcare.index');
    }
}
