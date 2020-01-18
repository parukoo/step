<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class ChangeCategoryIdAndUserIdToSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
          //既存のレコードを削除する
          DB::statement('DELETE FROM steps');
          $table->foreign('category_id')->references('id')->on('categories');
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('steps', function (Blueprint $table) {
          $table->dropForeign(['category_id']);
          $table->dropForeign(['user_id']);
        });
    }
}
