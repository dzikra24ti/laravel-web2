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
        'password_confirmation' => 'required|same:password',
    ];

    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules);
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:user,email,' . $id,
        'password' => 'nullable|confirmed|min:6',
    ];

    $validatedData = $request->validate($rules);

    // Jika password baru diisi, hash ulang
    if ($request->filled('password')) {
        $validatedData['password'] = Hash::make($request->password);
    } else {
        unset($validatedData['password']); // jangan ubah password lama
    }

    $user->update($validatedData);

    return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('hapus', 'Data berhasil dihapus!');
    }
}
