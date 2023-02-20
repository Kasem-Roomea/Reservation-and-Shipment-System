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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numTicket');
            $table->string('namePerson');
            $table->bigInteger('phonePerson')->default(0);
            $table->string('gender')->default('ذكر');
            $table->string('from');
            $table->string('to');
            $table->integer('priceTicket')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('rest')->default(0);
            $table->string('Nationality');
            $table->string('Birth');
            $table->bigInteger('numPassport');
            $table->date('datePassport');
            $table->string('placePassport');
            $table->integer('numVisa');
            $table->string('description')->default('');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tickets');
    }
};
