<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SliderSeeder::class,
            CategorySeeder::class,
            ProductOrderSeeder::class,
            ProductSeeder::class,
            SpecificationSeeder::class,
            PictureSeeder::class,
        ]);
    }
}
