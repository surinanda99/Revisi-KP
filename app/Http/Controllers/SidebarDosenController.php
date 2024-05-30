<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dosen.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function daftar_mhs_bimbingan()
    {
        return view('dosen.daftar_bimbingan.daftar_bimbingan');
    }

    public function logbook_bimbingan_mhs()
    {
        return view('dosen.logbook_bimbingan.logbook_bimbingan');
    }

    public function review_penyelia()
    {
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs');
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
