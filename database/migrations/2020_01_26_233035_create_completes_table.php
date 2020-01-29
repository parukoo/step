<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completes', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedbigInteger('user_id');
          $table->unsignedbigInteger('kostep_id');
          // 外部キー制約
          $table->foreign('kostep_id')->references('id')->on('kosteps')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completes');
    }
}
