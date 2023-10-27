<?php

namespace Database\Seeders;

use App\Models\Age;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Age::create(['group'=>'0-1']);
        Age::create(['group'=>'1-12']);
        Age::create(['group'=>'13-18']);
        Age::create(['group'=>'19-63']);
        Age::create(['group'=>'mas de 63']);
    }
}
