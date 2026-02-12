<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // show register page
    public function index(){
        return view('register');
    }

    // process register
    public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5'
        ]);

        if($validator->passes()){

            // SAVE USER
            User::create([
                'name' => 'User',
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('account.login')
                ->with('success','Registration Successful! Please Login.');
        }
        else{
            return redirect()->route('account.register')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
