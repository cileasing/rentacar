<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptRejectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accept_rejects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id')->unsigned()->unique();
            $table->integer('user_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->integer('status')->unsigned()->default(1);
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
        Schema::dropIfExists('accept_rejects');
    }
}
