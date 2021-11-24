<?php


namespace Sabt\Course\Repositories;


use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use function PHPUnit\Framework\isInstanceOf;

class SeasonRepository
{
    public function all()
    {
        return Season::all();
    }


    public function create($values)
    {
        return Season::create([
                                  "title"     => $values->title,
                                  "number"    => $this->generateNumber($values->course_id, $values->number),
                                  "course_id" => $values->course_id,
                                  "user_id"   => auth()->id()
                              ]);
    }

    public function delete($season)
    {
        return $season->delete();
    }

    public function edit($season, $values)
    {
        return $season->update([
                                   "title"  => $values->title,
                                   "number" => $this->generateNumber($season->course, $values->number),
                               ]);
    }


    public function updateStatus(Season $season, $status)
    {
        return $season->update([
                                   'status' => $status
                               ]);
    }

    private function generateNumber($course, $number)
    {
        $course = !$course instanceof Course ? Course::find($course) : $course;

        if (is_null($number))
        {
            $number = $course->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }

    public function updateConfirmationStatus($season, $status)
    {
        return $season->update([
                                   'confirmation_status' => $status
                               ]);
    }

}
