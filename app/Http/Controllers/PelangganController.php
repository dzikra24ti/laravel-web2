<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(){
		$data['dataPelanggan'] = Pelanggan::all();
		return view('admin.pelanggan.index',$data);
}

    /**
     * Show the form for creating a new resource.
     */
public function create(){
		return view('admin.pelanggan.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $data['first_name'] = $request->first_name;
		$data['last_name'] = $request->last_name;
		$data['birthday'] = $request->birthday;
		$data['gender'] = $request->gender;
		$data['email'] = $request->email;
		$data['phone'] = $request->phone;

		Pelanggan::create($data);

		return redirect()->route('pelanggan.index')->with('success','Penambahan Data Berhasil!');

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
    $data['dataPelanggan'] = Pelanggan::findOrFail($id);
    return view('admin.pelanggan.edit', $data);
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    // Menggunakan $id yang diterima dari rute
    $pelanggan_id = $id;

    // Mencari data Pelanggan berdasarkan ID atau menghentikan eksekusi jika tidak ditemukan
    $pelanggan = Pelanggan::findOrFail($pelanggan_id);

    // Memperbarui properti model Pelanggan dengan data dari request (form)
    $pelanggan->first_name = $request->first_name;
    $pelanggan->last_name = $request->last_name;
    $pelanggan->birthday = $request->birthday;
    $pelanggan->gender = $request->gender;
    $pelanggan->email = $request->email;
    $pelanggan->phone = $request->phone;

    // Menyimpan perubahan ke database
    $pelanggan->save();

    // Mengarahkan kembali ke halaman index dengan pesan sukses
    return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
