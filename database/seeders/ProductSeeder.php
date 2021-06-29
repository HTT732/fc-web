<?php

namespace Database\Seeders;
use Faker\Factory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("TRUNCATE TABLE products");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $faker = Factory::create('vi_VN');

        $cateArr = [];
        $cate = DB::table('categories')->get();
        foreach($cate as $u) {
            array_push($cateArr, ['id' => $u->id, 'slug'=>$u->slug]);
        };

        $files = File::allFiles(public_path('/uploads/products/large'));
        $now = Carbon::now();
        
        for($i = 0; $i < 50; $i++) {
            $path = '/uploads/products/large/'.$files[rand(0, count($files)-1)]->getFileName();
            $rand = rand(0, count($cateArr)-1);
            $data[] = [
                'name' => $faker->realText($maxNbChars = 12, $indexSize = 2),
                'description' => $faker->realText($maxNbChars = 10, $indexSize = 2),
                'short_description' => $faker->realText($maxNbChars = 10, $indexSize = 2),
                'price' => $faker->numberBetween('1000000', '10000000'),
                'thumb_url' => $path,
                'slug' => $cateArr[$rand]['slug'],
                // 'specification_id' => $specArr[rand(0, count($specArr)-1)],
                'category_id' => $cateArr[$rand]['id'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('products')->insert($data);
    }
}
