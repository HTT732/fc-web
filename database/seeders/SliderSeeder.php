<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            [
                'original_url' => '/uploads/banner/original/1.jpg',
                'small_url' => '/uploads/banner/original/1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'original_url' => '/uploads/banner/original/2.jpg',
                'small_url' => '/uploads/banner/original/2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'original_url' => '/uploads/banner/original/3.jpg',
                'small_url' => '/uploads/banner/original/3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'original_url' => '/uploads/banner/original/4.jpg',
                'small_url' => '/uploads/banner/original/4.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
