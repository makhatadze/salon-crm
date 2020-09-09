<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title_ge');
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('body_ge');
            $table->string('body_ru')->nullable();
            $table->string('body_en')->nullable();
            $table->string('duration_ge')->nullable();
            $table->string('duration_ru')->nullable();
            $table->string('duration_en')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('published')->default(true);
            $table->text('unit_ge')->nullable();
            $table->text('unit_ru')->nullable();
            $table->text('unit_en')->nullable();
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
        Schema::dropIfExists('services');
    }
}
