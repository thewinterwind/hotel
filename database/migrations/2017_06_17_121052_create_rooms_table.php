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
            $table->integer('room_type_id');
            $table->string('room_number'); // not all hotels might use integers for the room name
            $table->text('description')->nullable(); // a custom description can be added, if not, the room type one is used
            $table->string('direction', 2); // N, NE, E, SE, etc...
            $table->integer('sqm')->nullable(); // square meters can be overrided here
            $table->boolean('smoking')->nullable(); // smoking can be overrided here, if not, room type is used
            $table->char('calendar_color', 7)->nullable(); // hex code of the room color on the calendar
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
