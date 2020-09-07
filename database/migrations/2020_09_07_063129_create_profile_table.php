<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('profileable_id');
            $table->string('profileable_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birthday');
            $table->string('phone');
            $table->string('pid');
            $table->string('position');
            $table->string('salary');
            $table->string('salary_type');
            $table->string('percent');

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
        Schema::dropIfExists('profile');
    }
}
