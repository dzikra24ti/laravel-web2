<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;      // Import Class Role Spatie
use Illuminate\Support\Facades\Storage; // Import Facade Storage

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua resource (User).
     */
    public function index()
    {
        // Ambil semua data user dari database
        $data['dataUser'] = User::all();

        return view('admin.user.index', $data);
    }

    /**
     * Menampilkan formulir untuk membuat resource baru (User).
     */
    public function create()
    {
        // Ambil semua Role untuk ditampilkan di dropdown
        $data['roles'] = Role::all();

        return view('admin.user.create', $data);
    }

    /**
     * Menyimpan resource baru yang dibuat ke storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:7',
            'role'     => 'required', // Wajib memilih role
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // 1. Hash Password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 2. Upload Foto (Jika ada)
        if ($request->hasFile('avatar')) {
            // Simpan ke folder 'public/avatars'
            $validatedData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. Simpan User
        $user = User::create($validatedData);

        // 4. Pasang Role ke User
        $user->assignRole($request->role);

        // Redirect ke user.index
        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Menampilkan resource yang ditentukan (biasanya tidak digunakan di resource controller).
     */
    public function show(string $id)
    {
        // Implementasi default biasanya kosong jika tidak ada halaman detail spesifik
    }

    /**
     * Menampilkan formulir untuk mengedit resource yang ditentukan.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        $data['roles'] = Role::all(); // Kirim data role ke form edit

        return view('admin.user.edit', $data);
    }

    /**
     * Memperbarui resource yang ditentukan di storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id), // Abaikan ID user ini saat cek unique
            ],
            'password' => 'nullable|string|min:7', // Password boleh kosong saat update
            'role'     => 'required', // Role wajib dipilih
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Cek Password (Update hanya jika diisi)
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Jangan update password jika kosong
        }

        // 2. Cek Upload Foto Baru
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada dan file-nya ada di disk
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan foto baru
            $validatedData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. Update Data User
        $user->update($validatedData);

        // 4. Update Role (Sync mengganti role lama dengan yang baru)
        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Menghapus resource yang ditentukan dari storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profilnya juga dari storage
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
