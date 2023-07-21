<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:users',
            'email'=>'required',
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
        notify()->success('User added successfully'); 

        return redirect()->route('user.index');
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
        //
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'visible_password'=>'required',
            'role'=>'required',
        ]);
        $user = User::find($id);

        $user->name = $request->name;
        $user->email=$request->email;
        $user ->visible_password=$request->visible_password;
        $user->password=bcrypt($request->visible_password);
        
        $user->save();
        notify()->success('User updated successfully'); 

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        
        $user->delete();
        
        notify()->success('User deleted successfully'); 

        return redirect()->route('user.index');
    }
}
