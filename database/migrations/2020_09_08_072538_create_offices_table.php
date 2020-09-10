<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name_ge');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('address_ge');
            $table->string('address_en')->nullable();
            $table->string('address_ru')->nullable();
            $table->string('officeable_type')->nullable();
            $table->integer('officeable_id')->nullable();
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
        Schema::dropIfExists('offices');
    }
}
