<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Validasi dasar untuk store() dan update()
     */
    protected $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'birthday' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'email' => 'required|email|unique:pelanggan,email',
        'phone' => 'required|numeric',
    ];

    public function index(Request $request)
    {
        $filterableColumns = ['gender'];

        $searchableColumns = ['first_name','last_name','email'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
                    ->search($request,$searchableColumns)
					->paginate(10)->withQueryString();
        return view('admin.pelanggan.index', $data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
      // Validasi input sesuai aturan
        $validatedData = $request->validate($this->validationRules);

        // Simpan ke database
        Pelanggan::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit($id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi dengan pengecualian unique email untuk data ini
        $rules = $this->validationRules;
        $rules['email'] = 'required|email|unique:pelanggan,email,' . $id . ',pelanggan_id';

        $validatedData = $request->validate($rules);

        // Update data
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus!');
    }
}
