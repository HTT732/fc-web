<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("TRUNCATE TABLE specifications");
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $proArr = [];
        $pro = DB::table('products')->get();
        foreach($pro as $p) {
            array_push($proArr, $p->id);
        };
        $now = Carbon::now();
        for($i = 0; $i < 50; $i ++) {
            $data[] = [
                'size' => 'M',
                'guarantee' => '6 tháng',
                'product_id' => array_rand($proArr),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        DB::table('specifications')->insert($data);    
    }
}
