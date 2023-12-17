<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function Authlogin(Request $request){
        $remember= !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }elseif(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }elseif(Auth::user()->user_type == 4){
                return redirect('parent/dashboard');
            }else{
                return redirect('/')->with('error', 'Please Enter Correct Email & Password');
            }
        }else{
            return redirect('/')->with('error', 'Please Enter Correct Email & Password');
        }
    }
    public function forgotPassword(){
        return view('auth.forgot-password');
    }
    public function PostForgtoPassword(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/')->with('success', 'Password Changed Successfully');
        }else{
            return redirect('/')->with('error', 'Email Not Found');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully');
    }
}
