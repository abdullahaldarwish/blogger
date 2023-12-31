<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';

        $user->save();

        session()->flash('success','the user is an admin now');
        
        return redirect(route('users.index'));
    }

    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request){
        $user= auth()->user();

        $user->update([
            'name'=>$request->name,
            'about'=>$request->about
        ]);

        session()->flash('success','user updated successfully');
        return redirect()->back();
    }
}
