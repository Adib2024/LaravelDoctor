<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Insert data to table users 
        $user = User::create([
            'name' => 'adib',
            'email' => 'adib@gmail.com',
            'password' => 'secret123'
        ]);

        // 2. Insert data to table patients
        $patient = Patient::create([
            'user_id' => $user -> id,
            'pid' => 'ptn-6873',
            'sex' => 'male',
            'address' => 'Malaysia',
            'contact' => '56786'
        ]);
    }
}
