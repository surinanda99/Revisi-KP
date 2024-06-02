<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'password wajib diisi',
        ]);

        $infologin = [
            'email' =>$request->email,
            'password' =>$request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'mahasiswa') {
                return redirect('mahasiswa');
            } elseif (Auth::user()->role == 'dosen'){
                return redirect('dosen');
            } elseif (Auth::user()->role == 'koor'){
                return redirect('koor');
            } elseif (Auth::user()->role == 'admin'){
                return redirect('admin');
            }
            // return redirect('mahasiswa');
        }else{
            return redirect('')->withErrors('user dan password tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
