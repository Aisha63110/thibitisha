<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubSpecialitiesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sub_specialities')->insert([
            // Cardiology
            ['name' => 'Interventional Cardiology', 'speciality_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electrophysiology', 'speciality_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Heart Failure & Transplant', 'speciality_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Neurology
            ['name' => 'Stroke Medicine', 'speciality_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Epilepsy', 'speciality_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Neurocritical Care', 'speciality_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Obstetrics & Gynaecology
            ['name' => 'Maternal Fetal Medicine', 'speciality_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reproductive Endocrinology', 'speciality_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gynaecologic Oncology', 'speciality_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Paediatrics
            ['name' => 'Paediatric Cardiology', 'speciality_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paediatric Neurology', 'speciality_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Neonatology', 'speciality_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
