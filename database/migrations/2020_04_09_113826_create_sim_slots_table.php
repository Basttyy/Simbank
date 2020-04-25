<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_slots', function (Blueprint $table) {
            $table->id();
            $table->string('phone_num', 15);
            $table->float('balance', false, true)->default(0.00);
            $table->set('status', ['busy', 'idle', 'offline'])->default('offline');
            $table->set('provider', ['mtn', 'glo', 'airtel', '9mobile'])->default('mtn');
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
        Schema::dropIfExists('sim_slots');
    }
}
