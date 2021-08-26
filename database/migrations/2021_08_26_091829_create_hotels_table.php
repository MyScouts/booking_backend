<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('phone_number', 11)->nullable();
            $table->text('address')->nullable();
            $table->string('open_time', 7)->default('00:00')->nullable();
            $table->string('close_time', 7)->default('00:00')->nullable();
            $table->bigInteger('rating')->default(0);
            $table->string('medium_price', 10)->nullable();
            $table->integer('unit')->nullable();
            $table->string('post_code', 10)->nullable();
            $table->text('information')->nullable();
            $table->timestamp('delete_at')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
