<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            activity()
                ->inLog('login')
                ->causedBy($user)
                ->log('Melakukan login');

            // Redirect berdasarkan role
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('dashboardAdmin');
            } elseif (Auth::user()->hasRole('dosen')) {
                return redirect()->route('dashboardDosen');
            } elseif (Auth::user()->hasRole('mahasiswa')) {
                return redirect()->route('dashboardMahasiswa');
            } elseif (Auth::user()->hasRole('koor')) {
                return redirect()->route('dashboardKoor'); 
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
