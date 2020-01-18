<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        [
          'name' => '英語',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'プログラミング',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'ダイエット',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
      ]);
    }
}
