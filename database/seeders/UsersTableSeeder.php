<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
   
    public function run(): void
    {
        // Path to the CSV file
        $csvFile = storage_path('/app/public/csv_files/table_users.csv');

        // Create a CSV reader
        $csv = Reader::createFromPath($csvFile, 'r');

        // Skip the header row
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $name = $record['name'];
            $email = $record['email'];
            $nim_nip = $record['nim_nip'];
            $password = 12345678; // Generate an 8-character random password
            $role = $record['role']; // Assign the role from the CSV

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'nim_nip' => $nim_nip,
                'password' => Hash::make($password),
                'role' => $role,
            ]);
        }            
    }
}
