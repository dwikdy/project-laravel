<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if($user = Auth::user()){
         if($user->level == 'admin'){
             return redirect()->intended('/companies');
         }
         elseif($user->level == 'user'){
             return redirect()->intended('/companies');
         }
     }
         return view('admin.pages.login');
     }
 
     public function authentication(Request $request)
     {
 
         $credentials = $request->validate([
             'email' => ['required', 'email'],
             'password' => ['required']
         ]);
 
         if(Auth::attempt($credentials)){
             $request->session()->regenerate();
             $user = Auth::user();
             if($user->level == 'admin'){
                 // Alert::success('Sukses', 'Berhasil Login');
                 return redirect()->intended('/companies');
             }
             elseif($user->level == 'user'){
                 return redirect()->intended('/companies');
             }
             
         }
         return back()->withErrors([
             'email' => 'email atau password salah',
         ])->onlyInput('email');
         
     }
 
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect('login');
     }
}
