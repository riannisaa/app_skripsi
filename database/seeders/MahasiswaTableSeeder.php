<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Path to the CSV file
        $csvFile = storage_path('/app/public/csv_files/table_mahasiswa_new.csv');

        // Create a CSV reader
        $csv = Reader::createFromPath($csvFile, 'r');

        // Skip the header row
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $nama_mahasiswa = $record['nama_mahasiswa'];
            $nim = $record['nim'];
            $prodi = $record['prodi'];
            $dosen_pa = $record['dosen_pa'];

            $user = DB::table('users')
            ->where('name', $nama_mahasiswa) // Adjust the column name as needed
            ->first();

            $dosen = DB::table('dosen')
            ->where('nama_dosen', $dosen_pa)
            ->first();

            if ($user && $dosen) {
                $user_id = $user->id;
            
                DB::table('mahasiswa')->insert([
                    'user_id' => $user_id,
                    'dosenpa_id' => $dosen->id,
                    'nama_mahasiswa' => $nama_mahasiswa,
                    'nim' => $nim,
                    'prodi' => $prodi,
                    'status_mhs' => 0,
                ]);
            } 

        }   
    }
}
