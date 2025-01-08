<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = storage_path('/app/public/csv_files/table_jabatan.csv');

        // Baca file CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0);

        // Loop melalui setiap baris CSV dan masukkan ke dalam database
        foreach ($csv as $record) {
            $dosen = Dosen::where('nama_dosen', $record['nama_dosen'])->first();
            if ($dosen) {
                $dosen->jabatan_fungsional = $record['jabatan_fungsional'];
                $dosen->save();
            }
        }
    }
}
