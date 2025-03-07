<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationOnReceivals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // relation on schedule receival
        DB::statement('ALTER TABLE schedule_receivables MODIFY sells_id INTEGER;');
        Schema::table('schedule_receivables', function (Blueprint $table) {
            $table->integer('sells_id')->unsigned()->change();
        });
        Schema::table('schedule_receivables', function (Blueprint $table) {
            $table->foreign('sells_id')->references('id')->on('sells');
        });

        // relation on actual receivals
        DB::statement('ALTER TABLE actual_receiveds MODIFY sells_id INTEGER;');
        Schema::table('actual_receiveds', function (Blueprint $table) {
            $table->integer('sells_id')->unsigned()->change();
        });
        Schema::table('actual_receiveds', function (Blueprint $table) {
            $table->foreign('sells_id')->references('id')->on('sells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
