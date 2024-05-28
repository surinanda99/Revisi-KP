<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.dashboard');
    }

    public function pengajuan_kp()
    {
        return view('mahasiswa.pengajuan_kp.pilihDosbing');
    }

    public function form_kp()
    {
        return view('mahasiswa.pengajuan_kp.formPengajuan');
    }

    public function draft_kp()
    {
        return view('mahasiswa.pengajuan_kp.draftPengajuan');
    }


    //logbook
    public function logbook_kp()
    {
        return view('mahasiswa.logbook_kp.logbook_kp');
    }

    //review penyelia
    public function review_penyelia()
    {
        return view('mahasiswa.review_penyelia.review_penyelia');
    }

    public function Detail()
    {
        return view('mahasiswa.review_penyelia.detail_penilaian');
    }


    //profil mhs
    public function profil_mhs()
    {
        return view('mahasiswa.profil_mhs.profil_mhs');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
