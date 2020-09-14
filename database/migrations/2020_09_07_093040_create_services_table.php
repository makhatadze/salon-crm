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
            $table->text('body_ge');
            $table->text('body_ru')->nullable();
            $table->text('body_en')->nullable();
            $table->integer('duration_count');
            $table->string('duration_type');
            $table->integer('price')->nullable();
            $table->boolean('published')->default(true);
            $table->string('unit_ge')->nullable();
            $table->string('unit_ru')->nullable();
            $table->string('unit_en')->nullable();
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
        Schema::dropIfExists('services');
    }
}
