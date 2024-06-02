<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoorController extends Controller
{
    public function index()
    {
        return view('koor.dashboard');
    }
}
