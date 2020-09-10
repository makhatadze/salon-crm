<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title-ge');
            $table->string('title-ru')->nullable();
            $table->string('title-en')->nullable();
            $table->text('description-ge');
            $table->text('description-ru')->nullable();
            $table->text('description-en')->nullable();
            $table->integer('price');
            $table->integer('stock')->nullable();
            $table->boolean('published')->default(true);
            $table->integer('category_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
