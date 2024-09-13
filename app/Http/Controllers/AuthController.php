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
        $request->validate([
            'nim_npp' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('nim_npp', 'password');

        // Tentukan field yang digunakan untuk login
        $field = null;
        if (preg_match('/^\d{4}\.\d{2}\.\d{4}\.\d{3}$/', $credentials['nim_npp'])) {
            $field = 'npp'; // Format npp misalnya, jika Anda menggunakan format khusus
        } else {
            $field = 'nim'; // Untuk mahasiswa
        }

        // Sesuaikan kredensial
        $credentials[$field] = $credentials['nim_npp'];
        unset($credentials['nim_npp']);

        \Log::info('Field used for login:', ['field' => $field, 'credentials' => $credentials]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            activity()
                ->inLog('login')
                ->causedBy($user)
                ->log('Melakukan login');

            // Redirect berdasarkan role
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboardAdmin');
            } elseif ($user->hasRole('dosen')) {
                return redirect()->route('dashboardDosen');
            } elseif ($user->hasRole('mahasiswa')) {
                return redirect()->route('dashboardMahasiswa');
            } elseif ($user->hasRole('koor')) {
                return redirect()->route('dashboardKoor'); 
            }
        }

        return back()->withErrors([
            'nim_npp' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('nim_npp'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
