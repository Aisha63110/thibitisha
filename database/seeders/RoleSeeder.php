<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //truncate
        Role::truncate();

        //inserting some dummy data
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->description = 'System Administtrator';
        $admin->save();
        
        $staff = new Role();
        $staff->name = 'Staff';
        $staff->description =  ' KMPDC staff';
        $staff->save();

        $guest = new Role();
        $guest->name = 'Guest';
        $guest->description = 'Unauthenticated User';
        $guest->save();
    }
}
