<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Path to the CSV file
        $csvFile = storage_path('/app/public/csv_files/dospem_new.csv');

        // Create a CSV reader
        $csv = Reader::createFromPath($csvFile, 'r');

        // Skip the header row
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $nama_dosen = $record['nama_dosen'];
            $nip = $record['nip'];
            $keahlian = $record['keahlian'];
            $kapasitas_dp1 = 5;
            $peserta_dp1 = 0; 
            $kapasitas_dp2 = 5;
            $peserta_dp2 = 0; 

            $user = DB::table('users')
            ->where('nim_nip', $nip) // Adjust the column name as needed
            ->first();

            if ($user) {
                $user_id = $user->id;

                DB::table('dosen')->insert([
                    'user_id' => $user_id,
                    'nama_dosen' => $nama_dosen,
                    'nip' => $user->nim_nip,
                    'keahlian' => $keahlian,
                    'kapasitas_dp1' => $kapasitas_dp1,
                    'peserta_dp1' => $peserta_dp1,
                    'kapasitas_dp2' => $kapasitas_dp2,
                    'peserta_dp2' => $peserta_dp2,
                
            ]);
            }
        }    
    }
}   
