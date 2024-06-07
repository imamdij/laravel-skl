<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validasi = Validator::make($data, [
            'nomor_hp' => 'required|min:10|numeric',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'foto-profile' => 'required|mimes:png,jpg,jpeg,heic',
            'alamat' => 'required'
        ]);
        if($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        if($request->hasFile('foto-profile'))
        {
            $folder = 'public/image/profile'; // Membuat folder penyimpanan.
            $gambar = $request->file('foto-profile'); // Mengambil data dari request foto_profile.
            $nama_gambar = $gambar->getClientOriginalName(); // Memberikan nama pada file yang diupload.
            $path = $request->file('foto-profile')->storeAs($folder, $nama_gambar); // Mengirimkan gambar ke folder.
            $data['foto-profile'] = $nama_gambar; // Untuk Memberikan nama yang dikirim ke database.
        }

        Profile::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
