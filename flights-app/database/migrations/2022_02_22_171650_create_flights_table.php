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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id');
            $table->foreignId('origin_city_id');
            $table->foreignId('destination_city_id');
            $table->foreign('origin_city_id')
            ->references('id')
            ->on('cities')
            ->onDelete('cascade');
            $table->foreign('destination_city_id')
            ->references('id')
            ->on('cities')
            ->onDelete('cascade');

            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
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
        Schema::dropIfExists('flights');
    }
};
