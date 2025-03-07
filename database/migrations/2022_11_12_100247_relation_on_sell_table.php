<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationOnSellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For Sells on branch
        // First modify the branch id into integer
        DB::statement('ALTER TABLE sells MODIFY branch_id INTEGER;');
        Schema::table('sells', function (Blueprint $table) {
            $table->integer('branch_id')->unsigned()->change();
        });
        Schema::table('sells', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        // For Sells on Customer
        // First modify the Customer id into integer
        DB::statement('ALTER TABLE sells MODIFY customer_id INTEGER;');
        Schema::table('sells', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned()->change();
        });
        Schema::table('sells', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        
        // For Sells on Employee
        // First modify the Employee id into integer
        DB::statement('ALTER TABLE sells MODIFY employee_id INTEGER;');
        Schema::table('sells', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned()->change();
        });
        Schema::table('sells', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
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
