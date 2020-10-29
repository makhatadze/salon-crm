<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->ondelete('cascade');
            $table->foreignId('storage_id')->constrained('storages')->ondelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('departments')->ondelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->ondelete('set null');
            $table->float('stock');
            $table->integer('price');
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
        Schema::dropIfExists('storage_histories');
    }
}
