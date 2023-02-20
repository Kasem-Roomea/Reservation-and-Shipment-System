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
        Schema::create('trustees', function (Blueprint $table) {
            $table->id();
            $table->string('senderName');
            $table->bigInteger('senderPhone');
            $table->string('senderPlace');
            $table->string('receiverName');
            $table->bigInteger('receivedPhone');
            $table->bigInteger('receivedPhoneS')->default(000);
            $table->integer('price')->default(0);
            $table->integer('paid')->default(0);
            $table->string('description');
            $table->string('byName');
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
        Schema::dropIfExists('trustees');
    }
};
