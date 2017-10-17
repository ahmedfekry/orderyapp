<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;
class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();
        $request->session()->flash('success','User created successfully');
        return redirect('users');
    }


    public function edit($id)
    {

        $user = User::findOrfail($id);
        return view('users.edit', compact('user'));
    }


    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::findOrfail($id);

        $user->email = $request->email;
        $user->name = $request->name;
        if(isset($request->password) && !empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $request->session()->flash('success','User updated successfully');
        $user->save();

        return redirect('users');
    }


    public function destroy($id,Request $request)
    {
        $user = User::findOrfail($id);
        $user->delete();
        $request->session()->flash('success','User has been deleted successfully');         
        return back();
    }

}
