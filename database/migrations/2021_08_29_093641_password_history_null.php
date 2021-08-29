<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PasswordHistoryNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('password_histories', function (Blueprint $table) {
            $table->string('model_type')->nullable()->change();
            $table->string('model_id')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->string('created_at')->nullable()->change();
            $table->string('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('password_histories', function (Blueprint $table) {
            $table->string('model_type')->change();
            $table->string('model_id')->change();
            $table->string('password')->change();
            $table->string('created_at')->change();
            $table->string('updated_at')->change();
        });
    }
}
