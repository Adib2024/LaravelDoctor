<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicine = Medicine::create([
            'code' => 'mdc-ffewe',
            'name' => 'sangobian',
            'price' => 55,
            'expired' => '2024-01-21'
        ]);

        $medicine = Medicine::create([
            'code' => 'mdc-ewewq',
            'name' => 'panadol',
            'price' => 21,
            'expired' => '2024-01-22'
        ]);

        $medicine = Medicine::create([
            'code' => 'mdc-eweaq',
            'name' => 'ultraflu',
            'price' => 43,
            'expired' => '2024-01-25'
        ]);
    }
}
