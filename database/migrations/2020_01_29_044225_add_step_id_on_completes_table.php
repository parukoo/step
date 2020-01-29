<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddStepIdOnCompletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('completes', function (Blueprint $table) {
            DB::statement('DELETE FROM completes');
            $table->unsignedBigInteger('step_id');
            $table->foreign('step_id')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('completes', function (Blueprint $table) {
            $table->dropForeign(['step_id']);
            $table->dropColumn('step_id');
        });
    }
}
