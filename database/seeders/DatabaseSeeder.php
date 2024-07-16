<?php

  namespace Database\Seeders;

//  use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
  use Illuminate\Database\Seeder;
  use Database\Seeders\CountriesTableSeeder;
  use Database\Seeders\LanguagesTableSeeder;

  class DatabaseSeeder extends Seeder
  {
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        CountriesTableSeeder::class,
        LanguagesTableSeeder::class,
      ]);

    }
  }
