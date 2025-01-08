<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usr1 = User::create([
            'name' => 'Marsa Nabila',
            'nim_nip' => '2110512048',
            'email' => '2110512048@mahasiswa.upnvj.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $usr1->id,
            'dosenpa_id' => 5,
            'prodi' => 'S1 Sistem Informasi',
            'nim' => '2110512048',
            'nama_mahasiswa' => 'Marsa Nabila',
            'status_mhs' => 0,
        ]);

        $usr2 = User::create([
            'name' => 'Annisa Zhafira Adhya',
            'nim_nip' => '2210511106',
            'email' => '2210511106@mahasiswa.upnvj.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $usr2->id,
            'dosenpa_id' => 13,
            'prodi' => 'S1 Informatika',
            'nim' => '2210511106',
            'nama_mahasiswa' => 'Annisa Zhafira Adhya',
            'status_mhs' => 0,
        ]);

        $usr3 = User::create([
            'name' => 'Nasya Putri Salsabila',
            'nim_nip' => '2310501062',
            'email' => '2310501062@mahasiswa.upnvj.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $usr3->id,
            'dosenpa_id' => 35,
            'prodi' => 'D3 Sistem Informasi',
            'nim' => '2310501062',
            'nama_mahasiswa' => 'Nasya Putri Salsabila',
            'status_mhs' => 0,
        ]);
    }
}
