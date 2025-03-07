<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRelationShipOnBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // first modify the branch id into integer
        DB::statement('ALTER TABLE products MODIFY branch_id INTEGER;');
        Schema::table('products', function (Blueprint $table) {
            $table->integer('branch_id')->unsigned()->change();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
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
