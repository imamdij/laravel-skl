<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        return view('toko.index', compact('toko', 'user'));
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
        $input = $request->all();
        $validasi = Validator::make($input,[
                'nama_toko' => 'required|max:128|min:5|string',
                'desc_toko' => 'required',
                'kategori_toko' => 'required',
                'hari_buka' => 'required',
                'jam_buka' => 'required',
                'jam_libur' => 'required',
                'icon_toko' => 'required',
        ]);
        if($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        if($request->hasFile('icon_toko'))
        {
            $folder = 'public/image/toko'; // Membuat folder penyimpanan.
            $gambar = $request->file('icon_toko'); // Mengambil data dari request foto_profile.
            $nama_gambar = $gambar->getClientOriginalName(); // Memberikan nama pada file yang diupload.
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar); // Mengirimkan gambar ke folder.
            $input['icon_toko'] = $nama_gambar; // Untuk Memberikan nama yang dikirim ke database.
        }

        // konversi nilai array ke dalam string : 
        $hari = implode(',', $request->input('hari_buka'));
        $input['hari_buka'] = $hari;


        Toko::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);
        $data = $request->except('hari_buka');
        $data['hari_buka'] = implode(',', $request->input('hari_buka', []));

        if($request->hasFile('icon_toko')){

            // Validasi type file dan ukuran yang di perlukan
            $request->validate([
                'icon_toko' => 'required'
            ]);

            // Hapus gambar lama
            if($toko->icon_toko){
                $Filelama = 'public/images/toko/'. $toko->icon_toko;
                Storage::delete($Filelama);
            }

            // Simpan Gambar baru
            $gambar = $request->file('icon_toko');
            $nama_gambar = $gambar->getClientOriginalName(); // Memberikan nama pada file yang diupload.
            $gambar->storeAs('public/images/toko', $nama_gambar);

            // Update gambar baru ke database
            $data['icon_toko'] = $nama_gambar;
        }

        // Update data baru
        $toko->update($data);

        return redirect('/store');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Toko::find($id);
        $data->delete();
        return back();
    }
}
