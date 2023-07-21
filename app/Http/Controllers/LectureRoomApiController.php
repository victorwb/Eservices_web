<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LectureRoom;

class LectureRoomApiController extends Controller
{
    //
    public function index()
        {
            $users = LectureRoom::all();
            return response()->json($users);
        }
        
        public function store(Request $request)
        {
            $user = LectureRoom::create($request->all());
            return response()->json($user, 201);
        }
        
        public function update(Request $request, $id)
        {
            $user = LectureRoom::findOrFail($id);
            $user->update($request->all());
            return response()->json($user);
        }
        
        public function destroy($id)
        {
            $user = LectureRoom::findOrFail($id);
            $user->delete();
            return response()->json(null, 204);
        }

}
