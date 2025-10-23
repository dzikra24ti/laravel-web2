<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

        protected $validationRules = [
        'name' => 'required',
        'email' => 'required|email|unique:user,email',
        'password' => 'required',
        'password_confirmation' => 'required',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
        $data['password'] = Hash::make($request->password);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Validasi input sesuai aturan
        $validatedData = $request->validate($this->validationRules);

        // Simpan ke database
        User::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
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
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
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
    public function destroy($id)
    {
        $pelanggan = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('hapus', 'Data berhasil dihapus!');
    }
}
