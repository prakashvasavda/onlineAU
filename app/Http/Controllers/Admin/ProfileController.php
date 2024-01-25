<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller{
        
    public function edit(string $id){
        $data['menu']   = "User";
        $data['users']  = User::find($id);
        return view('admin.profile.edit',$data);
    }

    
    public function update(Request $request, string $id){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$id.',id',
            'password'  => 'confirmed',
        ]);

        
        if (empty($request->password)) {
            unset($request['password']);
        }else{
            $request['password'] = Hash::make($request->password);
        }

        $input = $request->except('_method', '_token', 'password_confirmation');
        User::whereId(auth()->user()->id)->update($input);
        return back()->with('success', 'Profile updated Successfully');
    }
}
