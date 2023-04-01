<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('is_admin')->paginate(5);
        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();
        // $user = User::create($request ->all());
        if ($user){
            return redirect()->back()->with('User Created Successifuly');
        }
        return redirect()->back()->with('User Creating Failed');

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User not found');
        }
        $users ->update($request->all());
        return back()->with('Success','User updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User not found');
        }
        $users ->delete();
        return back()->with('Success','User Deleted successfuly');
    }
}
