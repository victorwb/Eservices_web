<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatApiController extends Controller
{
    public function send(Request $request)
    { 
        // dd($request->name);
        $this->validate($request,[ 
            'name'=>'required',
            'email'=>'required',
            'text'=>'required',
         ]);

        Message::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'text'=>$request->text,
        ]);
        // dd('Message');
        return response()->json(['message'=>'Message has been registered']);
    }

    public function index()
{
    $hostels = Message::all();
    
    return response()->json($hostels);
}

}
