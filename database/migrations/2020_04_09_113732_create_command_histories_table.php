<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('command_value', 128);
            $table->integer('command_id', false, true)->nullable()->references('id')->on('Command');
            $table->integer('sim_slot_id', false, true)->nullable()->references('id')->on('SimSlot');
            $table->integer('user_id', false, true)->nullable()->references('id')->on('user');
            $table->set('status', ['pending', 'executing', 'completed', 'failed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_histories');
    }
}
