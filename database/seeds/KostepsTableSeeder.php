<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class KostepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kosteps')->insert([
            'title' => '私のプログラミング学習情報',
            'info' => '説明が入りますよ。説明が入りますよ。説明が入りますよ。説明が入りますよ。',
            'step_id' => 1,
            'completed' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('kosteps')->insert([
          'title' => '私のプログラミング学習情報2',
          'info' => '説明が入りますよ2。説明が入りますよ2。説明が入りますよ。説明が入りますよ。',
          'step_id' => 1,
          'completed' => 1,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
    }
}
