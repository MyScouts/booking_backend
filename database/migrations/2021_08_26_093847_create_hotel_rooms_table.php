<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hotel_id');
            $table->double('price')->default(0);
            $table->integer('unit')->nullable();
            $table->integer('room_id')->default(0);
            $table->text('description')->nullable();
            $table->bigInteger('rating')->default(0);
            $table->integer('people_of_room')->default(0);
            $table->integer('total_bed')->default(0);
            $table->text('category')->nullable();
            $table->timestamp('delete_at')->nullable();
            $table->timestamps();

            //
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_rooms');
    }
}
