<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LectureRoom;

class LectureRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectureRooms = LectureRoom::get();
        return view('admin.lectureRooms.index', compact('lectureRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lectureRooms.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:lecture_rooms',
            'rating'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg',
            'location'=>'required'
        ]);

        $image = $request->file('image')->store('public/files');
        LectureRoom::create([
            'name'=>$request->name,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'image'=>$image,
            'location'=>$request->location
        ]);
        notify()->success('LectureRoom added successfully'); 

        return redirect()->route('lectureRoom.index');

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
        $lectureRoom = LectureRoom::find($id);
        return view('admin.lectureRooms.edit', compact('lectureRoom'));
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

        $lectureRoom = LectureRoom::find($id);
        $image=$lectureRoom->image;
        // dd($lectureRoom);
        if($request->file('image')){
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');  
            // \Storage::delete($image);
        }

        $lectureRoom->name = $request->name;
        $lectureRoom->rating=$request->rating;
        $lectureRoom ->description=$request->description;
        $lectureRoom->image=$image;
        $lectureRoom ->location=$request->location;
        $lectureRoom->save();
        notify()->success('LectureRoom updated successfully'); 

        return redirect()->route('lectureRoom.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lectureRoom = LectureRoom::find($id);
        $filename= $lectureRoom->image;
        // dd($lectureRoom);
        $lectureRoom->delete();
        \Storage::delete($filename);
        notify()->success('LectureRoom deleted successfully'); 

        return redirect()->route('lectureRoom.index');
    }
}
