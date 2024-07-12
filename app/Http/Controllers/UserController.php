<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;


class UserController extends Controller
{
    public function loadRegister(){
        return view('auth.register');
    }

    
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->sendOtpNotification();

        return redirect()->route('verification.notice');
    }

    public function loadLogin(){
        return view('auth.login');
    }

    public function userLogin(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required',
        ]);
        
        $userCredential = $request->only('email','password');
        if(Auth::attempt($userCredential)){
            return redirect('/admin/dashboard');
        }else{
            return back()->with('error','Email and Password is incorrect');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/login');   
    }
}