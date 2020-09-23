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
<<<<<<< HEAD
            $table->foreignId('distributor_id')->nullable()->constrained('distribution_companies')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories');
=======
>>>>>>> b36776bc8653d46a9cbd8f7bf8c9a7043cb4d52b
            $table->text('description_ge');
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('price');
            $table->string('type');
            $table->float('stock');
            $table->string('unit');
            $table->boolean('published')->default(true);
<<<<<<< HEAD
            $table->integer('department_id')->nullable();
=======
>>>>>>> b36776bc8653d46a9cbd8f7bf8c9a7043cb4d52b
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
