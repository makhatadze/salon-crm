<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClientServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_services', function (Blueprint $table) {
            $table->foreignId('author')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('new_price');
            $table->integer('duration');
            $table->timestamp('session_endtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_services', function (Blueprint $table) {
            //
        });
    }
}
