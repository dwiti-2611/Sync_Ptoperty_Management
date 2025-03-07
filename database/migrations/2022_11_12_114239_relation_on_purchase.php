<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationOnPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // For purchase requisition on branch
        // First modify the branch id into integer
        DB::statement('ALTER TABLE purchase_requisitions MODIFY branch_id INTEGER;');
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->integer('branch_id')->unsigned()->change();
        });
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        // For purchase requisition on branch
        // First modify the branch id into integer
        DB::statement('ALTER TABLE purchase_requisitions MODIFY employee_id INTEGER;');
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned()->change();
        });
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });


        // For purchase order on branch
        // First modify the branch id into integer
        DB::statement('ALTER TABLE purchase_orders MODIFY branch_id INTEGER;');
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('branch_id')->unsigned()->change();
        });
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        // For purchase order on vendor
        // First modify the branch id into integer
        DB::statement('ALTER TABLE purchase_orders MODIFY vendor_id INTEGER;');
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('vendor_id')->unsigned()->change();
        });
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
