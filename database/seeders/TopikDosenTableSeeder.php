<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopikDosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = storage_path('/app/public/csv_files/topik_dosen.csv');

        $csv = Reader::createFromPath($csvFile, 'r');

        // Skip the header row
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {

            $topik = $record['topik'];
            $dosen = $record['dosen'];
           
            $data_topik = DB::table('data_topik')
            ->where('topik', $topik) // Adjust the column name as needed
            ->first();

            $data_dosen = DB::table('dosen')
            ->where('nama_dosen', $dosen)
            ->first();

            if ($data_topik && $data_dosen) {
            
                DB::table('topik_dosen')->insert([
                    'topik_id' => $data_topik->id,
                    'dosen_id' => $data_dosen->id,
                ]);
            } 
    }
}

}
