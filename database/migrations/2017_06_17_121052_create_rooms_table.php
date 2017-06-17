<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id'); // create a db that supports multiple hotels
            $table->string('room_number'); // not all hotels might use integers for the room name
            $table->text('description');
            $table->integer('customer_id')->nullable(); // customer may or may not be a member
            $table->string('facing', 2); // N, NE, E, SE, etc...
            $table->decimal('sqm', 7, 2); // square meters
            $table->boolean('paid')->default(0);
            $table->boolean('smoking')->default(0);
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
        Schema::drop('rooms');
    }
}
