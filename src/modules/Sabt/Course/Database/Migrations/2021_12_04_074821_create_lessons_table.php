<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('season_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
            $table->enum('confirmation_status', \Sabt\Course\Models\Lesson::$confirmationStatuses)
                  ->default(\Sabt\Course\Models\Lesson::CONFIRMATION_STATUS_PENDING);
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('time')->unsigned()->nullable();
            $table->integer('number')->unsigned()->nullable();
            $table->boolean('free')->default(false);
            $table->longText('body')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
