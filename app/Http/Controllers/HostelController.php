<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = Hostel::get();
        return view('admin.hostels.index', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hostels.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:hostels',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        Hostel::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('Hostel added successfully'); 

        return redirect()->route('hostel.index');

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
        $hostel = Hostel::find($id);
        return view('admin.hostels.edit', compact('hostel'));
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

        $hostel = Hostel::find($id);
        $image=$hostel->image;
        // dd($hostel);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $hostel->name = $request->name;
        $hostel->rating=$request->rating;
        $hostel ->description=$request->description;
        $hostel->image=$image;
        $hostel ->location=$request->location;
        $hostel->save();
        notify()->success('Hostel updated successfully'); 

        return redirect()->route('hostel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hostel = Hostel::find($id);
        $filename= $hostel->image;
        // dd($hostel);
        $hostel->delete();
        \Storage::delete($filename);
        notify()->success('Hostel deleted successfully'); 

        return redirect()->route('hostel.index');
    }
}
