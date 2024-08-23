<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index(){
        $pengumuman = Pengumuman::whereNotNull('published_at')->orderBy('published_at', 'desc')->get();
        return response()->json($pengumuman);
    }
}
