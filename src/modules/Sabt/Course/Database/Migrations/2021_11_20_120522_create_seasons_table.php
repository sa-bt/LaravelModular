<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('course_id');
            $table->string('title');
            $table->tinyInteger('number')->unsigned();
            $table->enum('confirmation_status', \Sabt\Course\Models\Season::$confirmationStatuses)
                  ->default(\Sabt\Course\Models\Season::CONFIRMATION_STATUS_PENDING);
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
        Schema::dropIfExists('seasons');
    }
}
