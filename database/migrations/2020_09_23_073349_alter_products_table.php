<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned()->index()->nullable()->after('id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
//            $table->bigInteger('distributor_id')->unsigned()->index()->nullable()->after('category_id');
//            $table->foreign('distributor_id')->references('id')->on('distribution_companies')->onDelete('set null');
//            $table->bigInteger('department_id')->unsigned()->index()->nullable()->after('distributor_id');
//            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
