<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use File;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("TRUNCATE TABLE pictures");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $files = File::allFiles(public_path('/uploads/products/large'));

        $user = DB::table('products')->select('id')->get();
        $arrId = [];

        foreach($user as $u) {
            array_push($arrId, $u->id);
        };

        $path = '/uploads/products/large';
        $now = Carbon::now();
        foreach($files as $key => $file) {
            $data[] = [
                'name' => $file->getFileName(),
                'small' => $path.'/'.$file->getFileName(),
                'medium' => $path.'/'.$file->getFileName(),
                'large' => $path.'/'.$file->getFileName(),
                'product_id' => $arrId[rand(0, count($arrId)-1)],
                'created_at' => $now,
                'updated_at' => $now
            ];
        };
        DB::table('pictures')->insert($data);
    }
}
