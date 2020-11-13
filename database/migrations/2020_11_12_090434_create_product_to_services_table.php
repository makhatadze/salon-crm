<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('client_services')->OnDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->OnDelete('cascade');
            $table->float('productquntity');
            $table->bigInteger('newproductprice');
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
        Schema::dropIfExists('product_to_services');
    }
}
