<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() : View
    {
        return view('auth.login');
    }

    public function verify(UserAuthVerifyRequest $request) : RedirectResponse
    {
        $data = $request->validated();
     
        if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'], 'role'=>'admin'])){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/penyakit');
        }else if(Auth::guard('user')->attempt(['email'=>$data['email'],'password'=>$data['password'], 'role'=>'user'])){
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }else{
            return redirect(route('login'))->with('msg', 'email dan password salah');
        }
    }

    public function logout() : RedirectResponse
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }else if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        return redirect(route('login'));
    }
}
