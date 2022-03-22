<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_datails', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('number');
            $table->date('avalable_date');
            $table->time('avalable_time');
            $table->string('place');
            $table->integer('price');
            $table->integer('event_type');
            $table->timestamps();
            $table->timestamp('delieted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_datails');
    }
};
