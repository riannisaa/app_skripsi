<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TopikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Path to the CSV file
        $csvFile = storage_path('/app/public/csv_files/table_topik.csv');

        // Create a CSV reader
        $csv = Reader::createFromPath($csvFile, 'r');

        // Skip the header row
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $jurusan = $record['jurusan'];
            $peminatan = $record['peminatan'];
            $topik = $record['topik'];
            $ket = $record['ket'];
            $kapasitas = 5; 
            $peserta = 0; 


            DB::table('data_topik')->insert([
                'jurusan' => $jurusan,
                'peminatan' => $peminatan,
                'topik' => $topik,
                'ket' => $ket,
                'kapasitas' => $kapasitas,
                'peserta' => $peserta,
            ]);
        }   
    }
}
