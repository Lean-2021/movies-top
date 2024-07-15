<?php

  namespace Database\Seeders;

  use App\Models\Language;
  use Carbon\Carbon;
  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
  use Illuminate\Database\Seeder;

  class LanguagesTableSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Language::insert([
        [
          'id' => 1,
          'name' => 'aleman',
          'flag' => 'alemania.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 2,
          'name' => 'arabe',
          'flag' => 'arabia-saudita.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 3,
          'name' => 'bengali',
          'flag' => 'banglades.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 4,
          'name' => 'chino',
          'flag' => 'china.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 5,
          'name' => 'coreano',
          'flag' => 'corea-del-sur.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 6,
          'name' => 'español',
          'flag' => 'espania.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 7,
          'name' => 'frances',
          'flag' => 'francia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 8,
          'name' => 'hindu',
          'flag' => 'india.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 9,
          'name' => 'ingles - estados unidos',
          'flag' => 'estados-unidos.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 10,
          'name' => 'italiano',
          'flag' => 'italia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 11,
          'name' => 'japones',
          'flag' => 'japon.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 12,
          'name' => 'marati',
          'flag' => 'india.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 13,
          'name' => 'portugues',
          'flag' => 'portugal.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 14,
          'name' => 'ruso',
          'flag' => 'rusia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 15,
          'name' => 'tamil',
          'flag' => 'india.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 16,
          'name' => 'telugu',
          'flag' => 'india.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 17,
          'name' => 'turco',
          'flag' => 'turquia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 18,
          'name' => 'vietnamita',
          'flag' => 'vietnam.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 19,
          'name' => 'griego',
          'flag' => 'grecia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 20,
          'name' => 'polaco',
          'flag' => 'polonia.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'id' => 21,
          'name' => 'ucraniano',
          'flag' => 'ucrania.svg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
      ]);
    }
  }
