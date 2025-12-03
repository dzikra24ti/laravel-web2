<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission (Wajib agar tidak error)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // role dengan huruf kecil
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        // Buat Akun ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Cek email biar gak duplikat
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // Passwordnya: password
            ]
        );
        $admin->assignRole($roleAdmin); // <--- Kasih jabatan Admin

        // Buat Akun USER BIASA
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($roleUser); // <--- Kasih jabatan User
    }
}
