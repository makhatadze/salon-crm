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
            $table->string('title_ge');
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_ge')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('price')->nullable();
            $table->string('type');
            $table->float('stock');
            $table->string('unit');
            $table->boolean('published')->default(true);
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
