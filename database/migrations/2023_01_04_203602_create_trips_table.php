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
        Schema::create('trips', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date('dateTrip');
            $table->string('from' );
            $table->string('to');
            $table->unsignedBigInteger('micro_id');
            $table->foreign('micro_id')->references('id')->on('micros')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('driver_id2');
            $table->foreign('driver_id2')->references('id')->on('drivers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('feels')->default(0);
            $table->integer('numPeople')->default(41);
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('trips');
    }
};
