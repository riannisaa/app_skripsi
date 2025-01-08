<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path ke file CSV
        $csvFile = storage_path('/app/public/csv_files/forms.csv');

        // Baca file CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0);

        // Loop melalui setiap baris CSV dan masukkan ke dalam database
        foreach ($csv as $record) {
            DB::table('forms')->insert([
                'form_id' => $record['form_id'],
                'accepting_responses' => $record['accepting_responses'],
            ]);
        }
    }
}
