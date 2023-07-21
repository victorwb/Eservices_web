<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->name);
        $this->validate($request,[ 
            'name'=>'required',
            'email'=>'required|unique:users',
            'visible_password'=>'required',
            'role'=>'required',
        ]);

        $password= bcrypt($request->visible_password);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'role'=>$request->role,
            'visible_password'=>$request->visible_password,
        ]);
        // dd('User');
        return response()->json(['message'=>'User has been registered']);
    }

    public function uploadPhoto(Request $request, string $id)
    {
        // dd($request->name);
        $this->validate($request,[ 
            'photo'=>'required',
        ]);

        
        $user = User::find($id);
        $photo=$hostel->photo;
        if($request->file('photo')){
            \Storage::delete($image);
            $photo = $request->file('photo')->store('public/files');  
            // \Storage::delete($image);
        }
        $user->image=$image;
        $user->save();
        // dd('User');
        return response()->json(['message'=>'image has been updated']);
    }

    public function login(Request $request)
    {
        // dd($request->name);
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            // Authentication failed..
            return response()->json(['message'=>'unauthorised'],401);
        }

        $user=$request->user();
        $tokenResult=$user->createToken('Personal token');
        $token=$tokenResult;
        $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();
        return response()->json(['data'=>[
            'user'=>Auth::user(),
            'access_token'=>$tokenResult->accessToken,
            'token_type'=>'Bearer ',
            'expires_at '=> Carbon::parse($tokenResult->expires_at)->ToTimeString()
        ]]);

    }
}
