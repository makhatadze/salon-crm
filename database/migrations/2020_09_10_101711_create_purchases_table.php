<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            //First
            $table->string('purchase_type');
            $table->string('overhead_number')->nullable();
            $table->string('purchase_number')->nullable();
            $table->integer('distributor_id');
            $table->timestamp('purchase_date');
            //Second
            $table->integer('office_id');
            $table->integer('department_id');
            $table->integer('responsible_person_id');
            $table->integer('getter_person_id');
            //third
            $table->boolean('dgg');
            //Array
            $table->json('array');
            //Footer
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
        Schema::dropIfExists('purchases');
    }
}
