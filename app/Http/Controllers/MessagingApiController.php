<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class MessagingApiController extends Controller
{
    //
    public function send(Request $request)
    { 
        // dd($request->name);
        $this->validate($request,[ 
            'email1'=>'required',
            'email2'=>'required',
            'text'=>'required', 
            'from'=>'required',
         ]);

        Chat::create([
            'email1'=>$request->email1, 
            'email2'=>$request->email2,
            'text'=>$request->text,
            'from'=>$request->from,
        ]);
        // dd('Chat');
        return response()->json(['message'=>'Chat has been registered']); 
    }

    public function index()
{
    $email1 = request('email1'); 
    // $type = request('type'); 
    $items = Chat::where('email1', '=', $email1)
                      ->orWhere('email2', '=', $email1)
                      ->get();
    
    return response()->json($items);
}

}
