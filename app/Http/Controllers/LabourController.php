<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labour;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labours = Labour::get();
        return view('admin.labours.index', compact('labours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.labours.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:labours',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        Labour::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('Labour added successfully'); 

        return redirect()->route('labour.index');

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
        $labour = Labour::find($id);
        return view('admin.labours.edit', compact('labour'));
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

        $labour = Labour::find($id);
        $image=$labour->image;
        // dd($labour);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $labour->name = $request->name;
        $labour->rating=$request->rating;
        $labour ->description=$request->description;
        $labour->image=$image;
        $labour ->location=$request->location;
        $labour->save();
        notify()->success('Labour updated successfully'); 

        return redirect()->route('labour.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $labour = Labour::find($id);
        $filename= $labour->image;
        // dd($labour);
        $labour->delete();
        \Storage::delete($filename);
        notify()->success('Labour deleted successfully'); 

        return redirect()->route('labour.index');
    }
}
