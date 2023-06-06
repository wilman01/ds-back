<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $role = Role::create(['name' => 'admin']);

        \App\Models\User::factory()->create([
            'cedula' => '13904840',
            'name' => 'Rafael',
            'last_name' => 'Velasquez',
            'email' => 'rafael.velasquez@fvf.com.ve',
        ])->assignRole('admin');

        $this->call(BrandsSeeder::class);
        $this->call(VehimodelSeeder::class);


    }
}
