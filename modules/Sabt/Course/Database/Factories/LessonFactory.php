<?php

namespace Sabt\Course\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Sabt\Course\Models\Season;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->title;
        return [
            "title"=>$title,
            "slug" => Str::slug($title),
            "user_id"   => auth()->id(),
            "number"=>random_int(1,999),
            "time" => 10,
            "free" => 1,
            "media_id" =>  UploadedFile::fake()->create('fileTest.rar', 10024),
            "body" => $this->faker->text
        ];
    }
}
