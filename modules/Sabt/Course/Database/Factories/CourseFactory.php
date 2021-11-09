<?php

namespace Sabt\Course\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Sabt\Course\Models\Course;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->word;
        return [
            'title' => $title,
            'teacher_id' => auth()->id(),
            'slug'=>$title,
            'priority'=>2,
            'price'=>150000,
            'percent'=>70,
            'type'=>Course::TYPE_CASH,
            'status'=>Course::STATUS_COMPLETED,
            'confirmation_status'=>Course::CONFIRMATION_STATUS_ACCEPTED,
        ];
    }

}
