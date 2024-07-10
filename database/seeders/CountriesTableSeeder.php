<?php

namespace Database\Seeders;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::insert([
            [
                'id'=> 1,
                'name'=> 'afganistan',
                'flag'=> 'afganistan.svg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
