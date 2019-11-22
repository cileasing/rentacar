<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('departure');
            $table->string('destination')->nullable();
            $table->string('drop_off_address');
            $table->string('pickup_address');
            $table->dateTime('pick_up_date');
            $table->dateTime('end_date');
            $table->string('vehicle_category');
            $table->string('additional_services');
            $table->string('vehicle_make');
            $table->string('company_name');
            $table->string('email');
            $table->string('phone');
            $table->integer('driver_id');
            $table->string('status');
            $table->integer('admin_id');
            $table->integer('company_id');
            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
