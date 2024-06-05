<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = Doctor::create([
            'name' => 'Dr. Smile',
            'phone' => '43253',  
        ]);

        $doctor = Doctor::create([
            'name' => 'Dr. Maile',
            'phone' => '46757',  
        ]);

        $doctor = Doctor::create([
            'name' => 'Dr. Shah',
            'phone' => '4633757',  
        ]);
    }
}
