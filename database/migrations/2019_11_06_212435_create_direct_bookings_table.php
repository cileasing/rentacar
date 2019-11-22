<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('phone');
            $table->string('pickup_address');
            $table->string('pickup_name');
            $table->string('pickup_latitude');
            $table->string('pickup_longitude');
            $table->string('dropoff_address');
            $table->string('dropoff_name');
            $table->string('dropoff_latitude');
            $table->string('dropoff_longitude');
            $table->string('status')->default('pending');
            $table->integer('company_id');
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
        Schema::dropIfExists('direct_bookings');
    }
}
