<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // User::factory(10)->create();

       // User::factory()->create([
       //     'name' => 'Test User',
       //     'email' => 'test@example.com',
       // ]);
       //disable the foreign key checks
       Schema::disableForeignKeyConstraints();
       $this ->call([
              RoleSeeder::class,
       ]);

        // call them individual seeders in a specific order
        $this ->call([
            UserSeeder::class,
        ]);
        $this ->call([
            SpecialitiesSeeder::class,
        ]);

        $this ->call([
            SubSpecialitiesSeeder::class,
        ]);

        //re-enable
        User::factory(200)->create();
        Schema::enableForeignKeyConstraints();
    }
}
